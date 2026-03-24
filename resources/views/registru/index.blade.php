@extends('layouts.app')

@section('title', 'Registrul meu - Nuva.ro — Evidență financiară pentru profesioniști independenți')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h1 class="page-title" style="margin-bottom:0;">Registrul meu</h1>
    <a href="{{ route('registru.create') }}" class="btn-primary-custom">+ Adauga</a>
</div>

@if(session('success'))
    <div class="alert-success-custom">{{ session('success') }}</div>
@endif

{{-- ── Dashboard Charts ───────────────────────────────── --}}
@if(!$entries->isEmpty())

{{-- Filtru perioadă --}}
<div class="chart-filter-wrap mb-3">
    <div class="chart-filter-bar">
        <span class="chart-filter-label">Perioadă:</span>
        @foreach([3 => '3 luni', 6 => '6 luni', 12 => '12 luni', 24 => '24 luni'] as $months => $label)
            <a href="{{ route('registru.index', ['chart_months' => $months]) }}"
               class="chart-filter-btn {{ !$chartYear && $chartMonths == $months ? 'active' : '' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>
    @if($availableYears->count() > 0)
    <div class="chart-filter-bar" style="margin-top:0.5rem;">
        <span class="chart-filter-label">An:</span>
        @foreach($availableYears as $yr)
            <a href="{{ route('registru.index', ['chart_year' => $yr]) }}"
               class="chart-filter-btn {{ $chartYear == $yr ? 'active' : '' }}">
                {{ $yr }}
            </a>
        @endforeach
    </div>
    @endif
</div>

<div class="charts-grid">
    <div class="glass-card" style="padding:1.25rem;">
        <p class="chart-title">
            Venituri vs Cheltuieli &mdash;
            @if($chartYear) {{ $chartYear }} @else ultimele {{ $chartMonths }} luni @endif
        </p>
        <canvas id="barChart"></canvas>
    </div>
    <div class="glass-card" style="padding:1.25rem;">
        <p class="chart-title">
            Cheltuieli pe metodă &mdash;
            @if($chartYear) {{ $chartYear }} @else ultimele {{ $chartMonths }} luni @endif
        </p>
        @if(empty($chartData['donut_values']))
            <p style="color:var(--text-muted);font-size:0.88rem;text-align:center;padding:2.5rem 0;">
                Nu există cheltuieli în perioada selectată.
            </p>
        @else
            <div style="position:relative;max-width:320px;margin:0 auto;">
                <canvas id="donutChart"></canvas>
            </div>
        @endif
    </div>
</div>
@endif

{{-- ── Registru ───────────────────────────────────────── --}}
<div class="glass-card">
    @if($entries->isEmpty())
        <p style="color:var(--text-muted);text-align:center;padding:2rem;">Nu exista inregistrari.</p>
    @else
        @php
            $totalIncasari = $entries->where('tip', 'incasare')->sum('suma');
            $totalPlati    = $entries->where('tip', 'plata')->sum('suma');
            $sold          = $totalIncasari - $totalPlati;
        @endphp
        <div class="sumar-row mb-3">
            <span class="sumar-inc">Incasari: <strong>{{ number_format($totalIncasari, 2, ',', '.') }} RON</strong></span>
            <span class="sumar-pla">Plati: <strong>{{ number_format($totalPlati, 2, ',', '.') }} RON</strong></span>
            <span class="sumar-sold">Sold: <strong>{{ number_format($sold, 2, ',', '.') }} RON</strong></span>
        </div>

        @php
            $luniRo  = ['','Ianuarie','Februarie','Martie','Aprilie','Mai','Iunie','Iulie','August','Septembrie','Octombrie','Noiembrie','Decembrie'];
            $grouped = $entries->groupBy(fn($e) => $e->data->format('Y-m'));
        @endphp

        @foreach($grouped as $luna => $lunaEntries)
            @php
                [$an, $luna_nr] = explode('-', $luna);
                $titlu   = $luniRo[(int)$luna_nr] . ' ' . $an;
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
<div id="bon-popup" class="bon-popup" style="display:none;position:fixed;z-index:9999;overflow:hidden;width:320px;">
    <div class="bon-popup-header">
        <span id="bon-popup-label" class="bon-popup-label">Atasament</span>
        <div style="display:flex;gap:0.4rem;align-items:center;">
            <a id="bon-popup-open" href="#" target="_blank" class="bon-popup-open">Deschide</a>
            <button onclick="closeBonPopup()" class="bon-popup-close">&times;</button>
        </div>
    </div>
    <div id="bon-popup-content" style="width:100%;height:380px;display:flex;align-items:center;justify-content:center;"></div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
// ── Charts ────────────────────────────────────────────
const chartData = @json($chartData);

function getChartThemeColors() {
    var isDark = (document.documentElement.getAttribute('data-theme') || 'dark') === 'dark';
    return {
        grid:   isDark ? 'rgba(255,255,255,0.06)' : 'rgba(0,0,0,0.06)',
        ticks:  isDark ? '#94a3b8' : '#64748b',
        legend: isDark ? '#f1f5f9' : '#0f172a',
    };
}

var barChartInstance = null;
var donutChartInstance = null;

// Bar chart
var barCtx = document.getElementById('barChart');
if (barCtx && chartData.labels) {
    var c = getChartThemeColors();
    barChartInstance = new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: chartData.labels,
            datasets: [
                {
                    label: 'Incasări',
                    data: chartData.incasari,
                    backgroundColor: 'rgba(34,197,94,0.7)',
                    borderColor: '#22c55e',
                    borderWidth: 1,
                    borderRadius: 4,
                },
                {
                    label: 'Cheltuieli',
                    data: chartData.plati,
                    backgroundColor: 'rgba(239,68,68,0.7)',
                    borderColor: '#ef4444',
                    borderWidth: 1,
                    borderRadius: 4,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    labels: { color: c.legend, font: { size: 12 }, boxWidth: 14 }
                },
                tooltip: {
                    callbacks: {
                        label: function(ctx) {
                            return ' ' + ctx.parsed.y.toLocaleString('ro-RO', { minimumFractionDigits: 2 }) + ' RON';
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: { color: c.grid },
                    ticks: { color: c.ticks, font: { size: 11 } }
                },
                y: {
                    grid: { color: c.grid },
                    ticks: {
                        color: c.ticks,
                        font: { size: 11 },
                        callback: function(v) { return v.toLocaleString('ro-RO') + ' RON'; }
                    },
                    beginAtZero: true
                }
            }
        }
    });
}

// Donut chart
var donutCtx = document.getElementById('donutChart');
if (donutCtx && chartData.donut_labels && chartData.donut_labels.length > 0) {
    var c = getChartThemeColors();
    donutChartInstance = new Chart(donutCtx, {
        type: 'doughnut',
        data: {
            labels: chartData.donut_labels,
            datasets: [{
                data: chartData.donut_values,
                backgroundColor: ['rgba(59,130,246,0.8)', 'rgba(168,85,247,0.8)', 'rgba(251,146,60,0.8)'],
                borderColor: ['#3b82f6', '#a855f7', '#fb923c'],
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            aspectRatio: 1.4,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { color: c.legend, font: { size: 12 }, padding: 14, boxWidth: 14 }
                },
                tooltip: {
                    callbacks: {
                        label: function(ctx) {
                            return ' ' + ctx.label + ': ' + ctx.parsed.toLocaleString('ro-RO', { minimumFractionDigits: 2 }) + ' RON';
                        }
                    }
                }
            }
        }
    });
}

// Update chart colors on theme toggle
function onThemeChange(theme) {
    var c = getChartThemeColors();
    if (barChartInstance) {
        barChartInstance.options.scales.x.grid.color = c.grid;
        barChartInstance.options.scales.x.ticks.color = c.ticks;
        barChartInstance.options.scales.y.grid.color = c.grid;
        barChartInstance.options.scales.y.ticks.color = c.ticks;
        barChartInstance.options.plugins.legend.labels.color = c.legend;
        barChartInstance.update();
    }
    if (donutChartInstance) {
        donutChartInstance.options.plugins.legend.labels.color = c.legend;
        donutChartInstance.update();
    }
}

// ── Bon preview popup ─────────────────────────────────
const bonPopup = document.getElementById('bon-popup');
let activeBonBtn = null;
let hoverTimer = null;

const isTouchDevice = () => window.matchMedia('(hover: none)').matches;

function showBonPopup(btn) {
    activeBonBtn = btn;
    const url  = btn.dataset.url;
    const mime = btn.dataset.mime || 'image/jpeg';
    const content  = document.getElementById('bon-popup-content');
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
    let top  = rect.bottom + 8;
    let left = rect.left;
    if (top + ph > window.innerHeight) top = rect.top - ph - 8;
    if (left + pw > window.innerWidth - 10) left = window.innerWidth - pw - 10;
    if (left < 10) left = 10;
    if (top  < 10) top  = 10;

    bonPopup.style.top  = top  + 'px';
    bonPopup.style.left = left + 'px';
    bonPopup.style.display = 'block';
}

document.querySelectorAll('.btn-bon-preview').forEach(function(btn) {
    btn.addEventListener('mouseenter', function() {
        if (isTouchDevice()) return;
        clearTimeout(hoverTimer);
        showBonPopup(btn);
    });
    btn.addEventListener('mouseleave', function() {
        if (isTouchDevice()) return;
        hoverTimer = setTimeout(function() {
            if (!bonPopup.matches(':hover')) closeBonPopup();
        }, 300);
    });
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        if (activeBonBtn === btn && bonPopup.style.display !== 'none') {
            closeBonPopup();
            return;
        }
        showBonPopup(btn);
    });
});

bonPopup.addEventListener('mouseenter', function() { clearTimeout(hoverTimer); });
bonPopup.addEventListener('mouseleave', function() {
    if (!isTouchDevice()) hoverTimer = setTimeout(closeBonPopup, 200);
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
