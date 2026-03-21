@extends('layouts.app')

@section('title', 'Registrele mele - PFA Expenses')

@section('content')
<h1 class="page-title">Registrele mele</h1>

<div class="glass-card" style="max-width:500px;">
    @if($years->isEmpty())
        <p style="color:rgba(255,255,255,0.6);text-align:center;padding:2rem;">Nu exista inregistrari.</p>
    @else
        <div class="d-flex flex-column gap-2">
            @foreach($years as $year)
            <div style="background:rgba(255,255,255,0.08);border-radius:10px;padding:0.75rem 1rem;display:flex;justify-content:space-between;align-items:center;">
                <span style="font-weight:600;">Registru {{ $year }}</span>
                <a href="{{ route('pdf.generate', [$user->id, $year]) }}"
                    style="background:rgba(102,126,234,0.4);border:1px solid rgba(102,126,234,0.6);color:#fff;padding:0.3rem 0.8rem;border-radius:8px;text-decoration:none;font-size:0.85rem;">
                    Descarca PDF
                </a>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
