<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AndreeaDataSeeder extends Seeder
{
    public function run(): void
    {
        $userId = 3; // andreea

        $entries = [
            // ========== FEBRUARIE ==========
            ['2024-02-07', 'incasare', 'numerar', 2500.00, 'CHITANTA SERIA REV 000/2024',        null,      100],
            ['2024-02-20', 'incasare', 'numerar', 5000.00, 'CHITANTA SERIA REV. 007/2024',       null,      100],
            ['2024-02-20', 'plata',    'numerar', 44.00,   'CHITANTA NR. 1630',                  'diverse', 100],
            ['2024-02-28', 'plata',    'numerar', 80.00,   'CHITANTA SERIA ISCOTE NR. 82583',    'diverse', 100],
            ['2024-02-28', 'plata',    'numerar', 65.00,   'CHITANTA NR.1628',                   'diverse', 100],
            ['2024-02-28', 'plata',    'numerar', 460.00,  'CHITANTA NR. 1627',                  'diverse', 100],
            ['2024-02-28', 'plata',    'numerar', 80.00,   'CHITANTA SERIA ISCOTE NR. 82584',    'diverse', 100],
            ['2024-02-28', 'plata',    'numerar', 460.00,  'CHITANTA 1629',                      'diverse', 100],

            // ========== MARTIE ==========
            ['2024-03-27', 'incasare', 'numerar', 1500.00, 'CHITANTA SERIA CCA NR. 146/2024',   null,      100],

            // ========== APRILIE ==========
            ['2024-04-02', 'incasare', 'numerar', 5000.00, 'CHITANTA SERIA REV 008/2024',        null,      100],
            ['2024-04-11', 'incasare', 'numerar', 1076.04, 'CHITANTA SERIA CCA NR. 147/2024',   null,      100],
            ['2024-04-11', 'incasare', 'numerar', 1000.00, 'CHITANTA SERIA REV. 001/11.04.2024', null,     100],
            ['2024-04-11', 'plata',    'numerar', 80.00,   'CHITANTA SERIA ISCOTE NR.83219',     'diverse', 100],
            ['2024-04-11', 'plata',    'numerar', 96.00,   'CHITANTA NR. 2633',                  'diverse', 100],
            ['2024-04-11', 'plata',    'numerar', 824.00,  'CHITANTA NR. 2632',                  'diverse', 100],
            ['2024-04-22', 'incasare', 'numerar', 250.00,  'CHITANTA SERIA CCA NR. 148/2024',   null,      100],

            // ========== MAI ==========
            ['2024-05-11', 'incasare', 'numerar', 3500.00, 'CHITANTA SERIA CCA NR. 151/2024',   null,      100],
            ['2024-05-26', 'incasare', 'numerar', 500.00,  'CHITANTA SERIA CCA NR. 150/2024',   null,      100],
            ['2024-05-27', 'incasare', 'numerar', 250.00,  'CHITANTA SERIA CCA NR.148/2024',    null,      100],
            ['2024-05-27', 'incasare', 'numerar', 588.98,  'CHITANTA SERIA CCA NR. 149/2024',   null,      100],
            ['2024-05-27', 'plata',    'numerar', 74.00,   'CHITANTA NR. 3853',                  'diverse', 100],
            ['2024-05-27', 'plata',    'numerar', 536.00,  'CHITANTA 3852',                      'diverse', 100],
            ['2024-05-27', 'plata',    'numerar', 80.00,   'CHITANTA SERIA ISCOTE NR.84044',     'diverse', 100],

            // ========== IUNIE ==========
            ['2024-06-11', 'incasare', 'numerar', 5000.00, 'CHITANTA SERIA CCA NR. 152/2024',   null,      100],
            ['2024-06-25', 'incasare', 'numerar', 2000.00, 'CHITANTA SERIA REV 002/2024',        null,      100],
            ['2024-06-26', 'plata',    'numerar', 75.00,   'CHITANTA NR.4707',                   'diverse', 100],
            ['2024-06-26', 'plata',    'numerar', 536.00,  'CHITANTA NR. 4706',                  'diverse', 100],
            ['2024-06-26', 'plata',    'numerar', 80.00,   'CHITANTA SERIA ISCOTE NR. 84595',    'diverse', 100],

            // ========== IULIE ==========
            ['2024-07-23', 'incasare', 'numerar', 2500.00, 'CHITANTA SERIA REV.006/2024',        null,      100],
            ['2024-07-26', 'incasare', 'numerar', 5000.00, 'CHITANTA SERIA CCA NR. 153/2024',   null,      100],
            ['2024-07-30', 'incasare', 'numerar', 4000.00, 'CHITANTA SERIA REV 003/2024',        null,      100],

            // ========== SEPTEMBRIE ==========
            ['2024-09-02', 'incasare', 'numerar', 5000.00, 'CHITANTA SERIA REV. 005/2024',       null,      100],
            ['2024-09-02', 'plata',    'numerar', 169.00,  'CHITANTA SERIA ISCOTE NR. 85675',    'diverse', 100],
            ['2024-09-02', 'plata',    'numerar', 184.00,  'CHITANTA NR. 6312',                  'diverse', 100],
            ['2024-09-02', 'plata',    'numerar', 1072.00, 'CHITANTA NR. 6311',                  'diverse', 100],

            // ========== OCTOMBRIE ==========
            ['2024-10-01', 'incasare', 'numerar', 3000.00, 'CHITANTA SERIA CCA NR. 154/2024',   null,      100],
            ['2024-10-02', 'incasare', 'numerar', 5000.00, 'CHITANTA SERIA CCA NR. 155/2024',   null,      100],
            ['2024-10-23', 'incasare', 'numerar', 300.00,  'CHITANTA SERIA CCA NR. 156/2024',   null,      100],
            ['2024-10-23', 'incasare', 'numerar', 300.00,  'CHITANTA SERIA CCA NR. 157/2024',   null,      100],
            ['2024-10-24', 'incasare', 'numerar', 700.00,  'CHITANTA SERIA CCA NR. 158/2024',   null,      100],
            ['2024-10-28', 'plata',    'numerar', 178.00,  'CHITANTA SERIA ISCOTE NR. 86638',    'diverse', 100],
            ['2024-10-28', 'plata',    'numerar', 178.00,  'CHITANTA NR. 7267',                  'diverse', 100],
            ['2024-10-28', 'plata',    'numerar', 1072.00, 'CHITANTA NR. 7266',                  'diverse', 100],

            // ========== NOIEMBRIE ==========
            ['2024-11-20', 'incasare', 'numerar', 500.00,  'CHITANTA SERIA CCA NR. 159/2024',   null,      100],
            ['2024-11-26', 'incasare', 'numerar', 2000.00, 'CHITANTA SERIA REV 004/2024',        null,      100],
            ['2024-11-27', 'incasare', 'banca',   5428.22, 'FACTURA CCA NR. 0001/2024',          null,      100],

            // ========== DECEMBRIE ==========
            ['2024-12-09', 'incasare', 'banca',   1000.00, 'FACTURA CCA NR. 0002/2024',          null,      100],
        ];

        $now = now();
        $rows = [];

        foreach ($entries as $e) {
            [$data, $tip, $metoda, $suma, $document, $tip_cheltuiala, $deductibilitate] = $e;

            if ($tip === 'incasare') {
                $tip_cheltuiala = null;
                $deductibilitate = 100;
            }

            $rows[] = [
                'user_id'         => $userId,
                'data'            => $data,
                'tip'             => $tip,
                'metoda'          => $metoda,
                'suma'            => $suma,
                'valuta'          => 'RON',
                'document'        => $document,
                'tip_cheltuiala'  => $tip_cheltuiala,
                'deductibilitate' => $deductibilitate,
                'created_at'      => $now,
                'updated_at'      => $now,
            ];
        }

        DB::table('registru_entries')->insert($rows);

        $this->command->info('Importate ' . count($rows) . ' inregistrari pentru andreea (user_id=3).');
    }
}
