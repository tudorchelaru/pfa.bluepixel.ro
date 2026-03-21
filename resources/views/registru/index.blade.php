@extends('layouts.app')

@section('title', 'Editare Registru - PFA Expenses')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h1 class="page-title" style="margin-bottom:0;">Registrul meu</h1>
    <a href="{{ route('registru.create') }}" class="btn-primary-custom">+ Adauga</a>
</div>

@if(session('success'))
    <div class="alert-success-custom">{{ session('success') }}</div>
@endif

<div class="glass-card">
    @if($entries->isEmpty())
        <p style="color:rgba(255,255,255,0.6);text-align:center;padding:2rem;">Nu exista inregistrari.</p>
    @else
        {{-- Totaluri --}}
        @php
            $totalIncasari = $entries->where('tip', 'incasare')->sum('suma');
            $totalPlati = $entries->where('tip', 'plata')->sum('suma');
            $sold = $totalIncasari - $totalPlati;
        @endphp
        <div class="d-flex gap-3 mb-3 flex-wrap">
            <span style="background:rgba(40,167,69,0.2);border:1px solid rgba(40,167,69,0.4);padding:0.4rem 1rem;border-radius:8px;">
                Incasari: <strong>{{ number_format($totalIncasari, 2, ',', '.') }} RON</strong>
            </span>
            <span style="background:rgba(220,53,69,0.2);border:1px solid rgba(220,53,69,0.4);padding:0.4rem 1rem;border-radius:8px;">
                Plati: <strong>{{ number_format($totalPlati, 2, ',', '.') }} RON</strong>
            </span>
            <span style="background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.2);padding:0.4rem 1rem;border-radius:8px;">
                Sold: <strong>{{ number_format($sold, 2, ',', '.') }} RON</strong>
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-borderless table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Data</th>
                        <th>Tip</th>
                        <th>Metoda</th>
                        <th>Document</th>
                        <th>Suma</th>
                        <th>Deduct.</th>
                        <th>Actiuni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($entries as $entry)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $entry->data->format('d.m.Y') }}</td>
                        <td><span class="badge-{{ $entry->tip }}">{{ ucfirst($entry->tip) }}</span></td>
                        <td>{{ ucfirst($entry->metoda) }}</td>
                        <td>{{ Str::limit($entry->document, 60) }}</td>
                        <td style="font-weight:600;white-space:nowrap;">
                            {{ number_format($entry->suma, 2, ',', '.') }} {{ $entry->valuta }}
                        </td>
                        <td>{{ $entry->deductibilitate }}%</td>
                        <td style="white-space:nowrap;">
                            <a href="{{ route('registru.edit', $entry->id) }}" class="btn-edit-custom">Edit</a>
                            <form method="POST" action="{{ route('registru.destroy', $entry->id) }}" class="d-inline"
                                onsubmit="return confirm('Stergi aceasta inregistrare?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger-custom">Sterge</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
