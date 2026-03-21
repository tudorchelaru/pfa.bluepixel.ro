<?php

namespace App\Http\Controllers;

use App\Models\RegistruEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistruController extends Controller
{
    public function create()
    {
        return view('registru.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'data'           => 'required|date',
            'tip'            => 'required|in:incasare,plata',
            'metoda'         => 'required|in:numerar,banca',
            'suma'           => 'required|numeric|min:0.01',
            'valuta'         => 'required|string|max:10',
            'document'       => 'required|string|max:500',
            'deductibilitate'=> 'nullable|integer|in:50,100',
            'tip_cheltuiala' => 'nullable|string|in:diverse,cincizeci_la_suta,rata_leasing',
            'bon_imagine'    => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,pdf|max:20480',
        ]);

        $validated['user_id'] = Auth::id();

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

    public function index()
    {
        $entries = RegistruEntry::where('user_id', Auth::id())
            ->orderBy('data', 'desc')
            ->get();

        return view('registru.index', compact('entries'));
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

        $validated = $request->validate([
            'data'           => 'required|date',
            'tip'            => 'required|in:incasare,plata',
            'metoda'         => 'required|in:numerar,banca',
            'suma'           => 'required|numeric|min:0.01',
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
