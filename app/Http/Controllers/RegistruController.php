<?php

namespace App\Http\Controllers;

use App\Models\RegistruEntry;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class RegistruController extends Controller
{
    public function create()
    {
        $firma = Auth::user()->firme()->first();
        $firme = Auth::user()->firme()->get();
        return view('registru.create', compact('firma', 'firme'));
    }

    public function store(Request $request)
    {
        $firma = Auth::user()->firme()->first();
        if (!$firma) {
            return redirect()->route('registru.create')
                ->with('error', 'Trebuie să configurezi datele firmei înainte de a adăuga înregistrări.');
        }

        $request->merge([
            'suma' => $this->normalizeAmountInput($request->input('suma')),
        ]);

        $validated = $request->validate([
            'data'           => 'required|date',
            'tip'            => 'required|in:incasare,plata',
            'metoda'         => 'required|in:numerar,banca',
            'suma'           => ['required', 'regex:/^\d+(\.\d+)?$/', 'numeric', 'min:0.01'],
            'valuta'         => 'required|string|max:10',
            'document'       => 'required|string|max:500',
            'deductibilitate'=> 'nullable|integer|in:50,100',
            'tip_cheltuiala' => 'nullable|string|in:diverse,cincizeci_la_suta,rata_leasing',
            'bon_imagine'    => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,pdf|max:20480',
        ]);

        $validated['user_id']  = Auth::id();
        $validated['firma_id'] = $firma->id;

        if ($validated['tip'] === 'incasare') {
            $validated['tip_cheltuiala'] = null;
            $validated['deductibilitate'] = 100;
        } else {
            $validated['deductibilitate'] = $validated['deductibilitate'] ?? 100;
        }

        unset($validated['bon_imagine']);

        if ($request->hasFile('bon_imagine') && $request->file('bon_imagine')->isValid()) {
            [$fileData, $mime] = $this->processFile($request->file('bon_imagine'));
            if ($fileData) {
                $validated['bon_imagine'] = $fileData;
                $validated['bon_mime'] = $mime;
            }
        }

        RegistruEntry::create($validated);

        return redirect()->route('registru.create')
            ->with('success', 'Inregistrare adaugata cu succes!');
    }

    public function index(\Illuminate\Http\Request $request)
    {
        $entries = RegistruEntry::where('user_id', Auth::id())
            ->orderBy('data', 'desc')
            ->get();

        // Years that have data — for the year filter buttons
        $availableYears = $entries
            ->groupBy(fn($e) => $e->data->format('Y'))
            ->keys()
            ->sort()
            ->values();

        $luniRo = ['','Ian','Feb','Mar','Apr','Mai','Iun','Iul','Aug','Sep','Oct','Nov','Dec'];
        $chartLabels   = [];
        $chartIncasari = [];
        $chartPlati    = [];
        $chartYear   = null;
        $chartMonths = null;

        // Mode A: specific year selected
        $requestedYear = $request->get('chart_year');
        if ($requestedYear && preg_match('/^\d{4}$/', $requestedYear)) {
            $chartYear = (int) $requestedYear;

            for ($m = 1; $m <= 12; $m++) {
                $key = $chartYear . '-' . str_pad($m, 2, '0', STR_PAD_LEFT);
                $chartLabels[]   = $luniRo[$m];
                $monthEntries    = $entries->filter(fn($e) => $e->data->format('Y-m') === $key);
                $chartIncasari[] = round((float)$monthEntries->where('tip', 'incasare')->sum('suma'), 2);
                $chartPlati[]    = round((float)$monthEntries->where('tip', 'plata')->sum('suma'), 2);
            }

            $platiForDonut = $entries->filter(fn($e) => $e->tip === 'plata' && $e->data->year === $chartYear);

        // Mode B: last N months
        } else {
            $chartMonths = (int) $request->get('chart_months', 6);
            if (!in_array($chartMonths, [3, 6, 12, 24])) {
                $chartMonths = 6;
            }

            for ($i = $chartMonths - 1; $i >= 0; $i--) {
                $month = now()->subMonths($i);
                $key   = $month->format('Y-m');
                $chartLabels[]   = $luniRo[(int)$month->format('n')] . ' \'' . $month->format('y');
                $monthEntries    = $entries->filter(fn($e) => $e->data->format('Y-m') === $key);
                $chartIncasari[] = round((float)$monthEntries->where('tip', 'incasare')->sum('suma'), 2);
                $chartPlati[]    = round((float)$monthEntries->where('tip', 'plata')->sum('suma'), 2);
            }

            $periodStart   = now()->subMonths($chartMonths - 1)->startOfMonth();
            $platiForDonut = $entries->filter(fn($e) => $e->tip === 'plata' && $e->data >= $periodStart);
        }

        // Donut data
        $donutLabels = [];
        $donutValues = [];
        foreach ($platiForDonut->groupBy('metoda') as $metoda => $group) {
            $donutLabels[] = ucfirst($metoda);
            $donutValues[] = round((float)$group->sum('suma'), 2);
        }

        $chartData = [
            'labels'       => $chartLabels,
            'incasari'     => $chartIncasari,
            'plati'        => $chartPlati,
            'donut_labels' => $donutLabels,
            'donut_values' => $donutValues,
        ];

        return view('registru.index', compact('entries', 'chartData', 'chartMonths', 'chartYear', 'availableYears'));
    }

    public function edit($id)
    {
        $entry = RegistruEntry::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('registru.edit', compact('entry'));
    }

    public function update(Request $request, $id)
    {
        $entry = RegistruEntry::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $request->merge([
            'suma' => $this->normalizeAmountInput($request->input('suma')),
        ]);

        $validated = $request->validate([
            'firma_id'       => 'nullable|exists:firme,id',
            'data'           => 'required|date',
            'tip'            => 'required|in:incasare,plata',
            'metoda'         => 'required|in:numerar,banca',
            'suma'           => ['required', 'regex:/^\d+(\.\d+)?$/', 'numeric', 'min:0.01'],
            'valuta'         => 'required|string|max:10',
            'document'       => 'required|string|max:500',
            'deductibilitate'=> 'nullable|integer|in:50,100',
            'tip_cheltuiala' => 'nullable|string|in:diverse,cincizeci_la_suta,rata_leasing',
            'bon_imagine'    => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,pdf|max:20480',
        ]);

        if ($validated['tip'] === 'incasare') {
            $validated['tip_cheltuiala'] = null;
            $validated['deductibilitate'] = 100;
        } else {
            $validated['deductibilitate'] = $validated['deductibilitate'] ?? 100;
        }

        unset($validated['bon_imagine']);

        if ($request->hasFile('bon_imagine') && $request->file('bon_imagine')->isValid()) {
            [$fileData, $mime] = $this->processFile($request->file('bon_imagine'));
            if ($fileData) {
                $validated['bon_imagine'] = $fileData;
                $validated['bon_mime'] = $mime;
            }
        } elseif ($request->boolean('sterge_bon')) {
            $validated['bon_imagine'] = null;
            $validated['bon_mime'] = null;
        }

        $entry->update($validated);

        return redirect()->route('registru.index')
            ->with('success', 'Inregistrare actualizata cu succes!');
    }

    public function destroy($id)
    {
        $entry = RegistruEntry::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $entry->delete();

        return redirect()->route('registru.index')
            ->with('success', 'Inregistrare stearsa cu succes!');
    }

    public function bon($id)
    {
        $entry = RegistruEntry::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (!$entry->bon_imagine) {
            abort(404);
        }

        $mime = $entry->bon_mime ?? 'image/jpeg';
        $isPdf = $mime === 'application/pdf';

        return response($entry->bon_imagine)
            ->header('Content-Type', $mime)
            ->header('Cache-Control', 'private, max-age=3600')
            ->header('X-Content-Type-Options', 'nosniff')
            ->header('Content-Security-Policy', $isPdf
                ? "default-src 'none'; style-src 'unsafe-inline';"
                : "default-src 'none';"
            )
            ->header('Content-Disposition', $isPdf
                ? 'inline; filename="document.pdf"'
                : 'inline; filename="bon.jpg"'
            );
    }

    public function ocr(Request $request)
    {
        $request->validate([
            'bon_ocr' => 'required|file|mimes:jpeg,jpg,png,gif,webp,pdf|max:20480',
        ]);

        if (!$this->commandExists('tesseract')) {
            return response()->json([
                'ok' => false,
                'message' => 'OCR indisponibil momentan (tesseract nu este instalat pe server).',
            ], 422);
        }

        $file = $request->file('bon_ocr');
        $text = $this->extractOcrText($file);

        if (trim($text) === '') {
            return response()->json([
                'ok' => false,
                'message' => 'Nu am putut citi textul din document. Incearca o poza mai clara.',
            ], 422);
        }

        return response()->json([
            'ok' => true,
            'fields' => $this->extractFieldsFromOcrText($text),
        ]);
    }

    private function normalizeAmountInput($value): ?string
    {
        if ($value === null) {
            return null;
        }

        $normalized = trim((string) $value);
        $normalized = str_replace(' ', '', $normalized);

        if (preg_match('/^\d+([,.]\d+)?$/', $normalized)) {
            return str_replace(',', '.', $normalized);
        }

        return $normalized;
    }

    private function extractOcrText(UploadedFile $file): string
    {
        $tmpDir = sys_get_temp_dir() . '/nuva-ocr-' . bin2hex(random_bytes(8));
        @mkdir($tmpDir, 0700, true);

        try {
            $mime = $file->getMimeType();
            $ocrImagePath = null;

            if ($mime === 'application/pdf') {
                if ($this->commandExists('pdftoppm')) {
                    $pdfPath = $tmpDir . '/input.pdf';
                    copy($file->getRealPath(), $pdfPath);

                    $prefix = $tmpDir . '/page';
                    $cmd = 'pdftoppm -f 1 -singlefile -png '
                        . escapeshellarg($pdfPath) . ' '
                        . escapeshellarg($prefix) . ' 2>/dev/null';
                    shell_exec($cmd);

                    $candidate = $prefix . '.png';
                    if (is_file($candidate)) {
                        $ocrImagePath = $candidate;
                    }
                }

                if (!$ocrImagePath) {
                    return '';
                }
            } else {
                [$jpegData] = $this->processImage($file);
                if (!$jpegData) {
                    return '';
                }

                $ocrImagePath = $tmpDir . '/input.jpg';
                file_put_contents($ocrImagePath, $jpegData);
            }

            return $this->runTesseract($ocrImagePath);
        } finally {
            $this->cleanupTmpDir($tmpDir);
        }
    }

    private function runTesseract(string $imagePath): string
    {
        $base = 'tesseract '
            . escapeshellarg($imagePath)
            . ' stdout -l ron+eng';

        $text = (string) shell_exec($base . ' --psm 6 2>/dev/null');
        if (trim($text) !== '') {
            return $text;
        }

        return (string) shell_exec($base . ' --psm 11 2>/dev/null');
    }

    private function extractFieldsFromOcrText(string $text): array
    {
        $text = preg_replace('/\r\n?/', "\n", $text);
        $lines = array_values(array_filter(array_map('trim', explode("\n", $text))));

        return [
            'suma' => $this->detectTotalAmount($text),
            'document' => $this->detectDocumentText($text, $lines),
            'data' => $this->detectDocumentDate($text),
        ];
    }

    private function detectTotalAmount(string $text): ?string
    {
        $matches = [];
        preg_match_all(
            '/(?:total(?:\s+de\s+plata)?|de\s+plata|total\s+lei|rest\s+de\s+plata)\D{0,24}(\d[\d\.\,\s]{0,16})/iu',
            $text,
            $matches
        );

        $candidates = [];
        foreach (($matches[1] ?? []) as $raw) {
            $val = $this->parseMoney($raw);
            if ($val !== null && $val > 0) {
                $candidates[] = $val;
            }
        }

        if (count($candidates) === 0) {
            preg_match_all('/\b\d[\d\.\,\s]{0,14}\d\b/u', $text, $fallback);
            foreach (($fallback[0] ?? []) as $raw) {
                $val = $this->parseMoney($raw);
                if ($val !== null && $val > 0 && $val < 100000000) {
                    $candidates[] = $val;
                }
            }
        }

        if (count($candidates) === 0) {
            return null;
        }

        $amount = max($candidates);
        return rtrim(rtrim(number_format($amount, 2, '.', ''), '0'), '.');
    }

    private function parseMoney(string $raw): ?float
    {
        $val = preg_replace('/[^\d\.,]/', '', $raw ?? '');
        if ($val === '') {
            return null;
        }

        $lastDot = strrpos($val, '.');
        $lastComma = strrpos($val, ',');
        $decimalPos = max($lastDot !== false ? $lastDot : -1, $lastComma !== false ? $lastComma : -1);

        if ($decimalPos >= 0) {
            $intPart = preg_replace('/[^\d]/', '', substr($val, 0, $decimalPos));
            $decPart = preg_replace('/[^\d]/', '', substr($val, $decimalPos + 1));
            if ($intPart === '') {
                $intPart = '0';
            }
            $normalized = $intPart . '.' . substr($decPart, 0, 2);
        } else {
            $normalized = preg_replace('/[^\d]/', '', $val);
        }

        if (!is_numeric($normalized)) {
            return null;
        }

        return (float) $normalized;
    }

    private function detectDocumentText(string $text, array $lines): ?string
    {
        $docType = null;
        foreach ($lines as $line) {
            if (preg_match('/\b(factura|bon\s*fiscal|chitanta|proforma)\b/iu', $line, $m)) {
                $docType = ucfirst(mb_strtolower($m[1]));
                break;
            }
        }

        $docNo = null;
        if (preg_match('/(?:seria|serie|nr\.?|numar|no\.?)\s*[:#]?\s*([A-Z0-9\-\/]{3,})/iu', $text, $m)) {
            $docNo = strtoupper($m[1]);
        }

        if ($docType || $docNo) {
            $label = trim(($docType ?? 'Document') . ' ' . ($docNo ?? ''));
            return mb_substr($label, 0, 500);
        }

        foreach ($lines as $line) {
            if (mb_strlen($line) < 4 || mb_strlen($line) > 70) {
                continue;
            }

            if (!preg_match('/[[:alpha:]]/u', $line)) {
                continue;
            }

            if (preg_match('/\b(cui|cod\s+fiscal|tva|tel|str\.?|www|http)\b/iu', $line)) {
                continue;
            }

            return mb_substr($line, 0, 500);
        }

        return null;
    }

    private function detectDocumentDate(string $text): ?string
    {
        if (preg_match('/\b(\d{4})-(\d{2})-(\d{2})\b/', $text, $m)) {
            if (checkdate((int) $m[2], (int) $m[3], (int) $m[1])) {
                return $m[1] . '-' . $m[2] . '-' . $m[3];
            }
        }

        if (preg_match('/\b(\d{2})[\.\/-](\d{2})[\.\/-](\d{4})\b/', $text, $m)) {
            if (checkdate((int) $m[2], (int) $m[1], (int) $m[3])) {
                return $m[3] . '-' . $m[2] . '-' . $m[1];
            }
        }

        return null;
    }

    private function commandExists(string $command): bool
    {
        $result = shell_exec('command -v ' . escapeshellarg($command) . ' 2>/dev/null');
        return trim((string) $result) !== '';
    }

    private function cleanupTmpDir(string $dir): void
    {
        if (!is_dir($dir)) {
            return;
        }

        $items = scandir($dir);
        if ($items === false) {
            return;
        }

        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }

            $path = $dir . DIRECTORY_SEPARATOR . $item;
            if (is_file($path)) {
                @unlink($path);
            }
        }

        @rmdir($dir);
    }

    private function processFile($file): array
    {
        if ($file->getMimeType() === 'application/pdf') {
            return [file_get_contents($file->getRealPath()), 'application/pdf'];
        }

        return $this->processImage($file);
    }

    private function processImage($file): array
    {
        $tmpPath  = $file->getRealPath();
        $mimeType = $file->getMimeType();

        $source = match (true) {
            in_array($mimeType, ['image/jpeg', 'image/jpg']) => @imagecreatefromjpeg($tmpPath),
            $mimeType === 'image/png'                        => @imagecreatefrompng($tmpPath),
            $mimeType === 'image/gif'                        => @imagecreatefromgif($tmpPath),
            $mimeType === 'image/webp'                       => @imagecreatefromwebp($tmpPath),
            default                                          => null,
        };

        if (!$source) {
            return [null, null];
        }

        // Corecteaza rotatia EXIF (pentru poze facute cu telefonul)
        if (function_exists('exif_read_data') && in_array($mimeType, ['image/jpeg', 'image/jpg'])) {
            $exif = @exif_read_data($tmpPath);
            $orientation = $exif['Orientation'] ?? 1;
            $source = match ($orientation) {
                3 => imagerotate($source, 180, 0),
                6 => imagerotate($source, -90, 0),
                8 => imagerotate($source, 90, 0),
                default => $source,
            };
        }

        $origW = imagesx($source);
        $origH = imagesy($source);

        $maxW = 900;
        if ($origW > $maxW) {
            $newW = $maxW;
            $newH = (int) round($origH * ($maxW / $origW));
        } else {
            $newW = $origW;
            $newH = $origH;
        }

        $resized = imagecreatetruecolor($newW, $newH);

        // Fundal alb pentru transparenta PNG
        $white = imagecolorallocate($resized, 255, 255, 255);
        imagefilledrectangle($resized, 0, 0, $newW, $newH, $white);

        imagecopyresampled($resized, $source, 0, 0, 0, 0, $newW, $newH, $origW, $origH);

        ob_start();
        imagejpeg($resized, null, 65);
        $data = ob_get_clean();

        imagedestroy($source);
        imagedestroy($resized);

        return [$data, 'image/jpeg'];
    }
}
