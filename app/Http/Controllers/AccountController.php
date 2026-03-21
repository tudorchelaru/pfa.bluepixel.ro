<?php

namespace App\Http\Controllers;

use App\Models\Firma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index()
    {
        $user  = Auth::user();
        $firma = $user->firme()->first();

        return view('account.index', compact('user', 'firma'));
    }

    // ── Profil (username + email) ─────────────────────────
    public function updateProfil(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:100',
            'email'    => 'nullable|email|max:191',
        ]);

        Auth::user()->update([
            'username' => $request->username,
            'email'    => $request->email,
        ]);

        return back()->with('success_profil', 'Profilul a fost actualizat.');
    }

    // ── Parola ────────────────────────────────────────────
    public function updateParola(Request $request)
    {
        $request->validate([
            'parola_curenta'  => 'required',
            'parola_noua'     => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($request->parola_curenta, Auth::user()->password)) {
            return back()->withErrors(['parola_curenta' => 'Parola curentă este incorectă.'])->with('tab', 'parola');
        }

        Auth::user()->update(['password' => $request->parola_noua]);

        return back()->with('success_parola', 'Parola a fost schimbată cu succes.');
    }

    // ── Firma: salvează (create sau update) ──────────────
    public function saveFirma(Request $request)
    {
        $request->validate([
            'nume'       => 'required|string|max:191',
            'cui'        => 'nullable|string|max:50',
            'nr_reg_com' => 'nullable|string|max:50',
            'adresa'     => 'nullable|string|max:255',
            'banca'      => 'nullable|string|max:100',
            'iban'       => 'nullable|string|max:50',
        ]);

        Auth::user()->firme()->updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'nume'       => $request->nume,
                'cui'        => $request->cui,
                'nr_reg_com' => $request->nr_reg_com,
                'adresa'     => $request->adresa,
                'banca'      => $request->banca,
                'iban'       => $request->iban,
                'is_default' => true,
            ]
        );

        return back()->with('success_firma', 'Datele firmei au fost salvate.')->with('tab', 'firma');
    }
}
