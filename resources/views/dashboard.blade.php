@extends('layouts.app')

@section('title', 'Dashboard - PFA Expenses')

@section('content')
<h1 class="page-title">Dashboard {{ $year }}</h1>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="glass-card text-center">
            <div style="font-size:2rem;margin-bottom:0.5rem;">Incasari</div>
            <div style="font-size:2rem;font-weight:700;color:#6fcf97;">{{ number_format($totalIncasari, 2, ',', '.') }} RON</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="glass-card text-center">
            <div style="font-size:2rem;margin-bottom:0.5rem;">Plati</div>
            <div style="font-size:2rem;font-weight:700;color:#eb5757;">{{ number_format($totalPlati, 2, ',', '.') }} RON</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="glass-card text-center">
            <div style="font-size:2rem;margin-bottom:0.5rem;">Sold</div>
            <div style="font-size:2rem;font-weight:700;color:{{ $sold >= 0 ? '#6fcf97' : '#eb5757' }};">
                {{ number_format($sold, 2, ',', '.') }} RON
            </div>
        </div>
    </div>
</div>

<div class="glass-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 style="font-size:1.2rem;font-weight:600;">Ultimele inregistrari</h2>
        <a href="{{ route('registru.create') }}" class="btn-primary-custom">+ Adauga</a>
    </div>

    @if($recentEntries->isEmpty())
        <p style="color:rgba(255,255,255,0.6);text-align:center;padding:2rem;">Nu exista inregistrari pentru {{ $year }}.</p>
    @else
        <div class="table-responsive">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Tip</th>
                        <th>Metoda</th>
                        <th>Document</th>
                        <th>Suma</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentEntries as $entry)
                    <tr>
                        <td>{{ $entry->data->format('d.m.Y') }}</td>
                        <td>
                            <span class="badge-{{ $entry->tip }}">{{ ucfirst($entry->tip) }}</span>
                        </td>
                        <td>{{ ucfirst($entry->metoda) }}</td>
                        <td>{{ Str::limit($entry->document, 50) }}</td>
                        <td style="font-weight:600;">{{ number_format($entry->suma, 2, ',', '.') }} {{ $entry->valuta }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-end mt-2">
            <a href="{{ route('registru.index') }}" style="color:rgba(255,255,255,0.7);font-size:0.9rem;">Vezi toate inregistrarile &rarr;</a>
        </div>
    @endif
</div>
@endsection
