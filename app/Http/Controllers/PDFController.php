<?php

namespace App\Http\Controllers;

use App\Models\RegistruEntry;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PDFController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $years = RegistruEntry::where('user_id', $user->id)
            ->selectRaw('YEAR(data) as year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');

        return view('pdf.index', compact('user', 'years'));
    }

    public function generate($userId, $year)
    {
        // Userul poate genera doar propriul PDF
        abort_if((int) $userId !== Auth::id(), 403);

        $user = Auth::user();

        $entries = RegistruEntry::where('user_id', $user->id)
            ->whereYear('data', $year)
            ->orderBy('data', 'asc')
            ->get();

        $firma = $user->firmaDefault ?? $user->firme()->first();

        $pdf = Pdf::loadView('pdf.registru', compact('user', 'entries', 'year', 'firma'))
            ->setPaper('a4', 'landscape');

        $slug     = $firma ? $firma->nume : $user->username;
        $slug     = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '_', $slug));
        $slug     = trim($slug, '_');
        $filename = 'registru_' . $slug . '_' . $year . '.pdf';

        return $pdf->download($filename);
    }
}
