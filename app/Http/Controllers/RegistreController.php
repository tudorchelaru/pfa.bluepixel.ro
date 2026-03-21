<?php

namespace App\Http\Controllers;

use App\Models\RegistruEntry;
use App\Models\User;

class RegistreController extends Controller
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

        return view('registre.index', compact('registre'));
    }
}
