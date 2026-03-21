<?php

namespace App\Console\Commands;

use App\Models\RegistruEntry;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ImportJsonData extends Command
{
    protected $signature = 'import:json {--path= : Calea catre folderul data/ din pfa-expenses}';
    protected $description = 'Importa datele din JSON-urile pfa-expenses in MySQL';

    public function handle(): int
    {
        $dataPath = $this->option('path') ?: base_path('../pfa-expenses/data');

        if (! is_dir($dataPath)) {
            $this->error("Folderul nu exista: {$dataPath}");
            $this->line("Foloseste: php artisan import:json --path=/calea/catre/data");
            return 1;
        }

        $this->info("Import din: {$dataPath}");

        // --- Importa utilizatori ---
        $usersFile = $dataPath . '/users.json';
        if (! file_exists($usersFile)) {
            $this->error("Nu gasesc users.json in {$dataPath}");
            return 1;
        }

        $usersJson = json_decode(file_get_contents($usersFile), true);
        $this->info("Gasit " . count($usersJson) . " utilizatori.");

        $userMap = []; // username => User model

        foreach ($usersJson as $u) {
            $user = User::updateOrCreate(
                ['username' => $u['username']],
                ['password' => $u['password']] // pastram hash-ul bcrypt existent
            );
            $userMap[$u['username']] = $user;
            $this->line("  Utilizator: {$u['username']} (id={$user->id})");
        }

        // --- Importa registru entries ---
        $jsonFiles = glob($dataPath . '/*_registru_*.json');

        if (empty($jsonFiles)) {
            $this->warn("Nu am gasit fisiere registru in {$dataPath}");
            return 0;
        }

        $totalImported = 0;
        $totalSkipped  = 0;

        foreach ($jsonFiles as $file) {
            $filename = basename($file);
            // Extrage username din pattern: username_registru_year.json
            if (! preg_match('/^(.+)_registru_(\d{4})\.json$/', $filename, $matches)) {
                $this->warn("  Ignorat (format necunoscut): {$filename}");
                continue;
            }

            $username = $matches[1];
            $year     = $matches[2];

            if (! isset($userMap[$username])) {
                $this->warn("  Utilizatorul '{$username}' nu exista in users.json, sarind: {$filename}");
                continue;
            }

            $user    = $userMap[$username];
            $entries = json_decode(file_get_contents($file), true);

            if (! is_array($entries)) {
                $this->warn("  Format invalid: {$filename}");
                continue;
            }

            $this->line("  Procesez {$filename}: " . count($entries) . " inregistrari");

            foreach ($entries as $e) {
                // Verifica daca exista deja (evita duplicate)
                $exists = RegistruEntry::where('user_id', $user->id)
                    ->where('data', $e['data'])
                    ->where('tip', $e['tip'])
                    ->where('suma', $e['suma'])
                    ->where('document', $e['document'])
                    ->exists();

                if ($exists) {
                    $totalSkipped++;
                    continue;
                }

                RegistruEntry::create([
                    'user_id'         => $user->id,
                    'data'            => $e['data'],
                    'tip'             => $e['tip'],
                    'metoda'          => $e['metoda'],
                    'suma'            => $e['suma'],
                    'valuta'          => $e['valuta'] ?? 'RON',
                    'document'        => $e['document'],
                    'deductibilitate' => $e['deductibilitate'] ?? 100,
                    'tip_cheltuiala'  => $e['tip_cheltuiala'] ?? null,
                ]);

                $totalImported++;
            }
        }

        $this->info("Import finalizat: {$totalImported} inregistrari importate, {$totalSkipped} sarite (deja existente).");
        return 0;
    }
}
