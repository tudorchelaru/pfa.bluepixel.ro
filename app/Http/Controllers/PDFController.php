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

        $pdf = Pdf::loadView('pdf.registru', compact('user', 'entries', 'year'))
            ->setPaper('a4', 'landscape');

        $filename = strtolower($user->username) . '_registru_' . $year . '.pdf';

        return $pdf->download($filename);
    }
}
