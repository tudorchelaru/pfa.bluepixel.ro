<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Registru {{ $user->username }} {{ $year }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 9px;
            color: #111;
            background: #fff;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
        }
        .header h1 {
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .header p {
            font-size: 10px;
            color: #444;
            margin-top: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background: #2c3e50;
            color: #fff;
            padding: 6px 4px;
            text-align: center;
            font-size: 8px;
            border: 1px solid #2c3e50;
        }
        td {
            padding: 4px;
            border: 1px solid #ccc;
            font-size: 8px;
            vertical-align: middle;
        }
        .col-nr { width: 4%; text-align: center; }
        .col-data { width: 9%; text-align: center; }
        .col-doc { width: 35%; }
        .col-suma { width: 13%; text-align: right; }
        tr:nth-child(even) { background: #f8f9fa; }
        tr.incasare td { }
        tr.plata td { }
        .totals-row td {
            background: #2c3e50;
            color: #fff;
            font-weight: bold;
            border-color: #2c3e50;
            text-align: right;
            font-size: 9px;
        }
        .totals-row td:first-child { text-align: center; }
        .footer {
            margin-top: 20px;
            font-size: 9px;
            color: #555;
            text-align: right;
        }
        .amount-positive { color: #27ae60; }
        .amount-negative { color: #e74c3c; }
    </style>
</head>
<body>

<div class="header">
    <h1>Registru de Incasari si Plati</h1>
    <p>Titular: <strong>{{ strtoupper($user->username) }}</strong> &nbsp;|&nbsp; Anul: <strong>{{ $year }}</strong> &nbsp;|&nbsp; Generat: {{ date('d.m.Y') }}</p>
</div>

@php
    $totalIncasariNumerar = 0;
    $totalIncasariBanca   = 0;
    $totalPlatiNumerar    = 0;
    $totalPlatiBanca      = 0;
    $nr = 1;
@endphp

<table>
    <thead>
        <tr>
            <th class="col-nr">Nr.<br>crt.</th>
            <th class="col-data">Data</th>
            <th class="col-doc">Felul, nr. si data documentului</th>
            <th class="col-suma">Incasari<br>Numerar</th>
            <th class="col-suma">Incasari<br>Banca</th>
            <th class="col-suma">Plati<br>Numerar</th>
            <th class="col-suma">Plati<br>Banca</th>
            <th style="width:8%;text-align:center;">Deduct.<br>%</th>
        </tr>
    </thead>
    <tbody>
        @foreach($entries as $entry)
        @php
            $incNumerar = ($entry->tip === 'incasare' && $entry->metoda === 'numerar') ? $entry->suma : null;
            $incBanca   = ($entry->tip === 'incasare' && $entry->metoda === 'banca')   ? $entry->suma : null;
            $platNumerar= ($entry->tip === 'plata'    && $entry->metoda === 'numerar') ? $entry->suma : null;
            $platBanca  = ($entry->tip === 'plata'    && $entry->metoda === 'banca')   ? $entry->suma : null;

            if ($incNumerar)  $totalIncasariNumerar += $incNumerar;
            if ($incBanca)    $totalIncasariBanca   += $incBanca;
            if ($platNumerar) $totalPlatiNumerar    += $platNumerar;
            if ($platBanca)   $totalPlatiBanca      += $platBanca;
        @endphp
        <tr class="{{ $entry->tip }}">
            <td class="col-nr">{{ $nr++ }}</td>
            <td class="col-data">{{ $entry->data->format('d.m.Y') }}</td>
            <td class="col-doc">{{ $entry->document }}</td>
            <td class="col-suma">{{ $incNumerar  ? number_format($incNumerar,  2, ',', '.') : '' }}</td>
            <td class="col-suma">{{ $incBanca    ? number_format($incBanca,    2, ',', '.') : '' }}</td>
            <td class="col-suma">{{ $platNumerar ? number_format($platNumerar, 2, ',', '.') : '' }}</td>
            <td class="col-suma">{{ $platBanca   ? number_format($platBanca,   2, ',', '.') : '' }}</td>
            <td style="text-align:center;">{{ $entry->tip === 'plata' ? $entry->deductibilitate . '%' : '' }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr class="totals-row">
            <td colspan="3" style="text-align:right;">TOTAL</td>
            <td>{{ number_format($totalIncasariNumerar, 2, ',', '.') }}</td>
            <td>{{ number_format($totalIncasariBanca,   2, ',', '.') }}</td>
            <td>{{ number_format($totalPlatiNumerar,    2, ',', '.') }}</td>
            <td>{{ number_format($totalPlatiBanca,      2, ',', '.') }}</td>
            <td></td>
        </tr>
    </tfoot>
</table>

@php
    $totalIncasari = $totalIncasariNumerar + $totalIncasariBanca;
    $totalPlati    = $totalPlatiNumerar + $totalPlatiBanca;
    $sold          = $totalIncasari - $totalPlati;
@endphp

<div class="footer">
    <p>Total incasari: <strong>{{ number_format($totalIncasari, 2, ',', '.') }} RON</strong>
    &nbsp;|&nbsp; Total plati: <strong>{{ number_format($totalPlati, 2, ',', '.') }} RON</strong>
    &nbsp;|&nbsp; Sold: <strong>{{ number_format($sold, 2, ',', '.') }} RON</strong></p>
</div>

</body>
</html>
