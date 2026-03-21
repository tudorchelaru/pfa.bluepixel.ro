<?php

namespace App\Http\Controllers;

use App\Models\RegistruEntry;
use Illuminate\Support\Facades\Auth;

class RegistreController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $years = RegistruEntry::where('user_id', $user->id)
            ->selectRaw('YEAR(data) as year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');

        return view('registre.index', compact('user', 'years'));
    }
}
