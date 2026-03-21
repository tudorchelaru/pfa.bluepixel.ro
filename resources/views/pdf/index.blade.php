@extends('layouts.app')

@section('title', 'Genereaza Registre PDF - PFA Expenses')

@section('content')
<h1 class="page-title">Genereaza Registre PDF</h1>

@if(empty($registre))
    <div class="glass-card">
        <p style="color:rgba(255,255,255,0.6);text-align:center;padding:2rem;">Nu exista date pentru generare PDF.</p>
    </div>
@else
    <div class="row g-3">
        @foreach($registre as $item)
        <div class="col-md-6 col-lg-4">
            <div class="glass-card">
                <h2 style="font-size:1.3rem;font-weight:700;margin-bottom:1rem;text-transform:capitalize;">
                    {{ $item['user']->username }}
                </h2>
                <div class="d-flex flex-column gap-2">
                    @foreach($item['years'] as $year)
                    <a href="{{ route('pdf.generate', [$item['user']->id, $year]) }}"
                        style="background:linear-gradient(135deg,rgba(102,126,234,0.4),rgba(118,75,162,0.4));border:1px solid rgba(102,126,234,0.4);border-radius:12px;padding:0.9rem 1.2rem;text-decoration:none;color:#fff;display:flex;justify-content:space-between;align-items:center;transition:all 0.2s;">
                        <span style="font-weight:600;">Registru {{ $year }}</span>
                        <span style="font-size:1.3rem;">PDF</span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection
