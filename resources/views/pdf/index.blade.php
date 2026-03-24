@extends('layouts.app')

@section('title', 'Genereaza PDF - Nuva.ro — Evidență financiară pentru profesioniști independenți')

@section('content')
<h1 class="page-title">Genereaza PDF</h1>

<div class="glass-card" style="max-width:500px;">
    @if($years->isEmpty())
        <p style="color:var(--text-muted);text-align:center;padding:2rem;">Nu exista date pentru generare PDF.</p>
    @else
        <div class="d-flex flex-column gap-2">
            @foreach($years as $year)
            <a href="{{ route('pdf.generate', [$user->id, $year]) }}" class="year-link-card">
                <span style="font-weight:600;">Registru {{ $year }}</span>
                <span style="font-size:1.1rem;color:var(--accent);">PDF ↓</span>
            </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
