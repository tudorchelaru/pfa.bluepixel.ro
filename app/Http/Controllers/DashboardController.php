<?php

namespace App\Http\Controllers;

use App\Models\RegistruEntry;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $year = now()->year;

        $entries = RegistruEntry::where('user_id', $user->id)
            ->whereYear('data', $year)
            ->orderBy('data', 'desc')
            ->get();

        $totalIncasari = $entries->where('tip', 'incasare')->sum('suma');
        $totalPlati = $entries->where('tip', 'plata')->sum('suma');
        $sold = $totalIncasari - $totalPlati;

        $recentEntries = $entries->take(5);

        return view('dashboard', compact('totalIncasari', 'totalPlati', 'sold', 'recentEntries', 'year'));
    }
}
