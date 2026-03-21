@extends('layouts.app')

@section('title', 'Genereaza PDF - PFA Expenses')

@section('content')
<h1 class="page-title">Genereaza PDF</h1>

<div class="glass-card" style="max-width:500px;">
    @if($years->isEmpty())
        <p style="color:rgba(255,255,255,0.6);text-align:center;padding:2rem;">Nu exista date pentru generare PDF.</p>
    @else
        <div class="d-flex flex-column gap-2">
            @foreach($years as $year)
            <a href="{{ route('pdf.generate', [$user->id, $year]) }}"
                style="background:linear-gradient(135deg,rgba(102,126,234,0.4),rgba(118,75,162,0.4));border:1px solid rgba(102,126,234,0.4);border-radius:12px;padding:0.9rem 1.2rem;text-decoration:none;color:#fff;display:flex;justify-content:space-between;align-items:center;transition:all 0.2s;">
                <span style="font-weight:600;">Registru {{ $year }}</span>
                <span style="font-size:1.2rem;">PDF</span>
            </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
