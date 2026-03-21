<?php

namespace App\Http\Controllers;

use App\Models\RegistruEntry;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function index()
    {
        $users = User::all();
        $registre = [];

        foreach ($users as $user) {
            $years = RegistruEntry::where('user_id', $user->id)
                ->selectRaw('YEAR(data) as year')
                ->distinct()
                ->orderByDesc('year')
                ->pluck('year');

            if ($years->isNotEmpty()) {
                $registre[] = [
                    'user'  => $user,
                    'years' => $years,
                ];
            }
        }

        return view('pdf.index', compact('registre'));
    }

    public function generate($userId, $year)
    {
        $user = User::findOrFail($userId);

        $entries = RegistruEntry::where('user_id', $userId)
            ->whereYear('data', $year)
            ->orderBy('data', 'asc')
            ->get();

        $pdf = Pdf::loadView('pdf.registru', compact('user', 'entries', 'year'))
            ->setPaper('a4', 'landscape');

        $filename = strtolower($user->username) . '_registru_' . $year . '.pdf';

        return $pdf->download($filename);
    }
}
