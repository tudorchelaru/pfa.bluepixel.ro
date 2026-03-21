@extends('layouts.app')

@section('title', 'Registre - PFA Expenses')

@section('content')
<h1 class="page-title">Registre</h1>

@if(empty($registre))
    <div class="glass-card">
        <p style="color:rgba(255,255,255,0.6);text-align:center;padding:2rem;">Nu exista registre.</p>
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
                    <div style="background:rgba(255,255,255,0.08);border-radius:10px;padding:0.75rem 1rem;display:flex;justify-content:space-between;align-items:center;">
                        <span style="font-weight:600;">{{ $year }}</span>
                        <a href="{{ route('pdf.generate', [$item['user']->id, $year]) }}"
                            style="background:rgba(102,126,234,0.4);border:1px solid rgba(102,126,234,0.6);color:#fff;padding:0.3rem 0.8rem;border-radius:8px;text-decoration:none;font-size:0.85rem;">
                            Descarca PDF
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection
