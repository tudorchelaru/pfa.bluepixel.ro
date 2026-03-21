@extends('layouts.app')

@section('title', 'Registrul meu - PFA Expenses')

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
        <div class="sumar-row mb-3">
            <span class="sumar-inc">Incasari: <strong>{{ number_format($totalIncasari, 2, ',', '.') }} RON</strong></span>
            <span class="sumar-pla">Plati: <strong>{{ number_format($totalPlati, 2, ',', '.') }} RON</strong></span>
            <span class="sumar-sold">Sold: <strong>{{ number_format($sold, 2, ',', '.') }} RON</strong></span>
        </div>

        @php
            $luniRo = ['','Ianuarie','Februarie','Martie','Aprilie','Mai','Iunie','Iulie','August','Septembrie','Octombrie','Noiembrie','Decembrie'];
            $grouped = $entries->groupBy(fn($e) => $e->data->format('Y-m'));
        @endphp

        @foreach($grouped as $luna => $lunaEntries)
            @php
                [$an, $luna_nr] = explode('-', $luna);
                $titlu = $luniRo[(int)$luna_nr] . ' ' . $an;
                $incLuna = $lunaEntries->where('tip', 'incasare')->sum('suma');
                $plaLuna = $lunaEntries->where('tip', 'plata')->sum('suma');
            @endphp

            <div class="luna-section">
                <div class="luna-header">
                    <span class="luna-titlu">{{ $titlu }}</span>
                    <div class="luna-sumar">
                        <span class="sumar-inc-sm">+{{ number_format($incLuna, 2, ',', '.') }}</span>
                        <span class="sumar-pla-sm">-{{ number_format($plaLuna, 2, ',', '.') }}</span>
                    </div>
                </div>

                {{-- Tabel desktop --}}
                <div class="d-none d-md-block table-responsive">
                    <table class="table table-borderless table-sm registru-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Data</th>
                                <th>Tip</th>
                                <th>Metoda</th>
                                <th>Document</th>
                                <th>Suma</th>
                                <th>Ded.</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lunaEntries as $i => $entry)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $entry->data->format('d.m.Y') }}</td>
                                <td><span class="badge-{{ $entry->tip }}">{{ ucfirst($entry->tip) }}</span></td>
                                <td>{{ ucfirst($entry->metoda) }}</td>
                                <td class="col-doc">
                                    <span>{{ $entry->document }}</span>
                                    @if($entry->bon_imagine)
                                        <button type="button" class="atas-badge btn-bon-preview"
                                            data-url="{{ route('registru.bon', $entry->id) }}"
                                            data-mime="{{ $entry->bon_mime ?? 'image/jpeg' }}">
                                            {{ $entry->bon_mime === 'application/pdf' ? 'PDF' : '📎' }}
                                        </button>
                                    @endif
                                </td>
                                <td class="col-suma">{{ number_format($entry->suma, 2, ',', '.') }} RON</td>
                                <td>{{ $entry->deductibilitate }}%</td>
                                <td class="col-actiuni">
                                    <a href="{{ route('registru.edit', $entry->id) }}" class="btn-tbl btn-tbl-yellow">✎</a>
                                    <form method="POST" action="{{ route('registru.destroy', $entry->id) }}" class="d-inline"
                                        onsubmit="return confirm('Stergi aceasta inregistrare?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-tbl btn-tbl-red">✕</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Carduri mobile --}}
                <div class="d-md-none entry-cards">
                    @foreach($lunaEntries as $entry)
                    <div class="entry-card">
                        <div class="entry-card-top">
                            <div class="entry-card-left">
                                <span class="badge-{{ $entry->tip }}">{{ ucfirst($entry->tip) }}</span>
                                <span class="entry-card-data">{{ $entry->data->format('d.m.Y') }}</span>
                                <span class="entry-card-metoda">{{ ucfirst($entry->metoda) }}</span>
                            </div>
                            <div class="entry-card-suma">{{ number_format($entry->suma, 2, ',', '.') }} RON</div>
                        </div>
                        <div class="entry-card-doc">
                            {{ $entry->document }}
                            @if($entry->bon_imagine)
                                <button type="button" class="atas-badge btn-bon-preview"
                                    data-url="{{ route('registru.bon', $entry->id) }}"
                                    data-mime="{{ $entry->bon_mime ?? 'image/jpeg' }}">
                                    {{ $entry->bon_mime === 'application/pdf' ? 'PDF' : '📎' }}
                                </button>
                            @endif
                        </div>
                        <div class="entry-card-actions">
                            <a href="{{ route('registru.edit', $entry->id) }}" class="card-btn card-btn-yellow">Editeaza</a>
                            <form method="POST" action="{{ route('registru.destroy', $entry->id) }}"
                                onsubmit="return confirm('Stergi aceasta inregistrare?')" style="margin-left:auto;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="card-btn card-btn-red">Sterge</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @endif
</div>

{{-- Popup previzualizare atasament --}}
<div id="bon-popup" style="display:none;position:fixed;z-index:9999;background:rgba(20,10,40,0.97);border:1px solid rgba(255,255,255,0.2);border-radius:16px;box-shadow:0 20px 60px rgba(0,0,0,0.6);overflow:hidden;width:320px;">
    <div style="display:flex;justify-content:space-between;align-items:center;padding:0.6rem 0.9rem;border-bottom:1px solid rgba(255,255,255,0.1);">
        <span id="bon-popup-label" style="font-size:0.82rem;color:rgba(255,255,255,0.7);">Atasament</span>
        <div style="display:flex;gap:0.4rem;align-items:center;">
            <a id="bon-popup-open" href="#" target="_blank" style="font-size:0.78rem;color:rgba(150,180,255,0.9);text-decoration:none;padding:0.2rem 0.5rem;border:1px solid rgba(150,180,255,0.3);border-radius:5px;">Deschide</a>
            <button onclick="closeBonPopup()" style="background:none;border:none;color:rgba(255,255,255,0.6);font-size:1.1rem;cursor:pointer;line-height:1;padding:0 0.2rem;">&times;</button>
        </div>
    </div>
    <div id="bon-popup-content" style="width:100%;height:380px;display:flex;align-items:center;justify-content:center;"></div>
</div>
@endsection

@push('scripts')
<script>
const bonPopup = document.getElementById('bon-popup');
let activeBonBtn = null;

const isTouchDevice = () => window.matchMedia('(hover: none)').matches;
let hoverTimer = null;

function showBonPopup(btn) {
    activeBonBtn = btn;
    const url = btn.dataset.url;
    const mime = btn.dataset.mime || 'image/jpeg';
    const content = document.getElementById('bon-popup-content');
    const openLink = document.getElementById('bon-popup-open');

    openLink.href = url;
    content.innerHTML = '';

    if (mime === 'application/pdf') {
        document.getElementById('bon-popup-label').textContent = 'Document PDF';
        const embed = document.createElement('embed');
        embed.src = url;
        embed.type = 'application/pdf';
        embed.style.cssText = 'width:100%;height:100%;border:none;';
        content.appendChild(embed);
    } else {
        document.getElementById('bon-popup-label').textContent = 'Imagine bon';
        const img = document.createElement('img');
        img.src = url;
        img.style.cssText = 'max-width:100%;max-height:380px;object-fit:contain;display:block;';
        content.appendChild(img);
    }

    const rect = btn.getBoundingClientRect();
    const pw = 320, ph = 440;
    let top = rect.bottom + 8;
    let left = rect.left;
    if (top + ph > window.innerHeight) top = rect.top - ph - 8;
    if (left + pw > window.innerWidth - 10) left = window.innerWidth - pw - 10;
    if (left < 10) left = 10;
    if (top < 10) top = 10;

    bonPopup.style.top = top + 'px';
    bonPopup.style.left = left + 'px';
    bonPopup.style.display = 'block';
}

document.querySelectorAll('.btn-bon-preview').forEach(btn => {
    // Desktop: hover
    btn.addEventListener('mouseenter', function() {
        if (isTouchDevice()) return;
        clearTimeout(hoverTimer);
        showBonPopup(btn);
    });
    btn.addEventListener('mouseleave', function() {
        if (isTouchDevice()) return;
        hoverTimer = setTimeout(() => {
            if (!bonPopup.matches(':hover')) closeBonPopup();
        }, 300);
    });

    // Click (mobil + desktop fallback)
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        if (activeBonBtn === btn && bonPopup.style.display !== 'none') {
            closeBonPopup();
            return;
        }
        showBonPopup(btn);
    });
});

bonPopup.addEventListener('mouseenter', () => clearTimeout(hoverTimer));
bonPopup.addEventListener('mouseleave', () => {
    if (!isTouchDevice()) {
        hoverTimer = setTimeout(closeBonPopup, 200);
    }
});

document.addEventListener('click', function(e) {
    if (!bonPopup.contains(e.target) && !e.target.closest('.btn-bon-preview')) closeBonPopup();
});

function closeBonPopup() {
    bonPopup.style.display = 'none';
    document.getElementById('bon-popup-content').innerHTML = '';
    activeBonBtn = null;
}
</script>
@endpush
