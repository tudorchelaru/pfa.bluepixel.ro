@extends('layouts.app')

@section('title', 'Registrele mele - Nuva.ro — Evidență financiară pentru profesioniști independenți')

@section('content')
<h1 class="page-title">Registrele mele</h1>

<div class="glass-card" style="max-width:500px;">
    @if($years->isEmpty())
        <p style="color:var(--text-muted);text-align:center;padding:2rem;">Nu exista inregistrari.</p>
    @else
        <div class="d-flex flex-column gap-2">
            @foreach($years as $year)
            <div style="background:var(--sumar-sold-bg);border:1px solid var(--border);border-radius:10px;padding:0.75rem 1rem;display:flex;justify-content:space-between;align-items:center;">
                <span style="font-weight:600;color:var(--text);">Registru {{ $year }}</span>
                <a href="{{ route('pdf.generate', [$user->id, $year]) }}"
                    style="background:var(--atas-bg);border:1px solid var(--atas-border);color:var(--accent);padding:0.3rem 0.8rem;border-radius:8px;text-decoration:none;font-size:0.85rem;font-weight:600;transition:background 0.15s;">
                    Descarca PDF
                </a>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
