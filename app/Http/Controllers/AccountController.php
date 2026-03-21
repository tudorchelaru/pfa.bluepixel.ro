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
        $firme = $user->firme()->orderByDesc('is_default')->orderBy('nume')->get();

        return view('account.index', compact('user', 'firme'));
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

    // ── Firme: adaugă ─────────────────────────────────────
    public function storeFirma(Request $request)
    {
        $request->validate([
            'nume'       => 'required|string|max:191',
            'cui'        => 'nullable|string|max:50',
            'nr_reg_com' => 'nullable|string|max:50',
            'adresa'     => 'nullable|string|max:255',
            'banca'      => 'nullable|string|max:100',
            'iban'       => 'nullable|string|max:50',
        ]);

        $user = Auth::user();

        // Prima firmă adăugată devine implicit default
        $isFirst = $user->firme()->count() === 0;

        if ($isFirst || $request->boolean('is_default')) {
            $user->firme()->update(['is_default' => false]);
        }

        $user->firme()->create([
            'nume'       => $request->nume,
            'cui'        => $request->cui,
            'nr_reg_com' => $request->nr_reg_com,
            'adresa'     => $request->adresa,
            'banca'      => $request->banca,
            'iban'       => $request->iban,
            'is_default' => $isFirst || $request->boolean('is_default'),
        ]);

        return back()->with('success_firma', 'Firma a fost adăugată.')->with('tab', 'firme');
    }

    // ── Firme: actualizează ───────────────────────────────
    public function updateFirma(Request $request, Firma $firma)
    {
        abort_if($firma->user_id !== Auth::id(), 403);

        $request->validate([
            'nume'       => 'required|string|max:191',
            'cui'        => 'nullable|string|max:50',
            'nr_reg_com' => 'nullable|string|max:50',
            'adresa'     => 'nullable|string|max:255',
            'banca'      => 'nullable|string|max:100',
            'iban'       => 'nullable|string|max:50',
        ]);

        if ($request->boolean('is_default')) {
            Auth::user()->firme()->update(['is_default' => false]);
        }

        $firma->update([
            'nume'       => $request->nume,
            'cui'        => $request->cui,
            'nr_reg_com' => $request->nr_reg_com,
            'adresa'     => $request->adresa,
            'banca'      => $request->banca,
            'iban'       => $request->iban,
            'is_default' => $request->boolean('is_default'),
        ]);

        return back()->with('success_firma', 'Firma a fost actualizată.')->with('tab', 'firme');
    }

    // ── Firme: setează default ────────────────────────────
    public function setDefault(Firma $firma)
    {
        abort_if($firma->user_id !== Auth::id(), 403);

        Auth::user()->firme()->update(['is_default' => false]);
        $firma->update(['is_default' => true]);

        return back()->with('success_firma', "\"{$firma->nume}\" setată ca firmă principală.")->with('tab', 'firme');
    }

    // ── Firme: șterge ─────────────────────────────────────
    public function destroyFirma(Firma $firma)
    {
        abort_if($firma->user_id !== Auth::id(), 403);

        $wasDefault = $firma->is_default;
        $firma->delete();

        // Dacă era default, setăm automat prima rămasă
        if ($wasDefault) {
            Auth::user()->firme()->first()?->update(['is_default' => true]);
        }

        return back()->with('success_firma', 'Firma a fost ștearsă.')->with('tab', 'firme');
    }
}
