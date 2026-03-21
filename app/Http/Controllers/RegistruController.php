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
        ]);

        $validated['user_id'] = Auth::id();

        if ($validated['tip'] === 'incasare') {
            $validated['tip_cheltuiala'] = null;
            $validated['deductibilitate'] = 100;
        } else {
            $validated['deductibilitate'] = $validated['deductibilitate'] ?? 100;
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
        ]);

        if ($validated['tip'] === 'incasare') {
            $validated['tip_cheltuiala'] = null;
            $validated['deductibilitate'] = 100;
        } else {
            $validated['deductibilitate'] = $validated['deductibilitate'] ?? 100;
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
}
