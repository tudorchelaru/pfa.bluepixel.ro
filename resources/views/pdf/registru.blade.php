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
            font-size: 14px;
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
            margin-bottom: 0;
        }
        th {
            background: #2c3e50;
            color: #fff;
            padding: 5px 4px;
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
        .col-nr    { width: 4%;  text-align: center; }
        .col-data  { width: 9%;  text-align: center; }
        .col-doc   { width: 37%; }
        .col-suma  { width: 11%; text-align: right; }
        .col-deduct{ width: 7%;  text-align: center; }

        tr:nth-child(even) td { background: #f8f9fa; }

        .month-header td {
            background: #34495e;
            color: #fff;
            font-weight: bold;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 5px 8px;
            border-color: #34495e;
        }

        .month-total td {
            background: #ecf0f1;
            font-weight: bold;
            font-size: 8px;
            border: 1px solid #bbb;
            text-align: right;
            color: #2c3e50;
        }
        .month-total td:first-child { text-align: right; }

        .grand-total td {
            background: #2c3e50;
            color: #fff;
            font-weight: bold;
            border-color: #2c3e50;
            text-align: right;
            font-size: 9px;
        }

        .summary-table {
            width: 50%;
            margin-left: auto;
            margin-top: 15px;
            border-collapse: collapse;
        }
        .summary-table td {
            padding: 5px 8px;
            border: 1px solid #ccc;
            font-size: 9px;
        }
        .summary-table .label { font-weight: bold; background: #ecf0f1; }
        .summary-table .value { text-align: right; }
    </style>
</head>
<body>

<div class="header">
    <h1>Registru de Incasari si Plati</h1>
    <p>Titular: <strong>{{ strtoupper($user->username) }}</strong> &nbsp;|&nbsp; Anul: <strong>{{ $year }}</strong> &nbsp;|&nbsp; Generat: {{ date('d.m.Y') }}</p>
</div>

@php
    $luniRo = [
        1=>'Ianuarie', 2=>'Februarie', 3=>'Martie', 4=>'Aprilie',
        5=>'Mai', 6=>'Iunie', 7=>'Iulie', 8=>'August',
        9=>'Septembrie', 10=>'Octombrie', 11=>'Noiembrie', 12=>'Decembrie',
    ];

    // Grupeaza pe luni
    $byMonth = [];
    foreach ($entries as $entry) {
        $m = (int) $entry->data->format('n');
        $byMonth[$m][] = $entry;
    }
    ksort($byMonth);

    $grandIncNum  = 0;
    $grandIncBanca = 0;
    $grandPlatNum  = 0;
    $grandPlatBanca = 0;
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
            <th class="col-deduct">Deduct.<br>%</th>
        </tr>
    </thead>
    <tbody>
    @php $nr = 1; @endphp
    @foreach($byMonth as $luna => $lunaEntries)
        @php
            $mIncNum   = 0; $mIncBanca  = 0;
            $mPlatNum  = 0; $mPlatBanca = 0;
        @endphp

        {{-- Header luna --}}
        <tr class="month-header">
            <td colspan="8">{{ $luniRo[$luna] }}</td>
        </tr>

        @foreach($lunaEntries as $entry)
        @php
            $incNum  = ($entry->tip==='incasare' && $entry->metoda==='numerar') ? (float)$entry->suma : null;
            $incBanca= ($entry->tip==='incasare' && $entry->metoda==='banca')   ? (float)$entry->suma : null;
            $platNum = ($entry->tip==='plata'    && $entry->metoda==='numerar') ? (float)$entry->suma : null;
            $platBanca=($entry->tip==='plata'    && $entry->metoda==='banca')   ? (float)$entry->suma : null;

            if ($incNum)   $mIncNum   += $incNum;
            if ($incBanca) $mIncBanca += $incBanca;
            if ($platNum)  $mPlatNum  += $platNum;
            if ($platBanca)$mPlatBanca+= $platBanca;
        @endphp
        <tr>
            <td class="col-nr">{{ $nr++ }}</td>
            <td class="col-data">{{ $entry->data->format('d.m.Y') }}</td>
            <td class="col-doc">{{ $entry->document }}</td>
            <td class="col-suma">{{ $incNum   !== null ? number_format($incNum,   2, ',', '.') : '' }}</td>
            <td class="col-suma">{{ $incBanca !== null ? number_format($incBanca, 2, ',', '.') : '' }}</td>
            <td class="col-suma">{{ $platNum  !== null ? number_format($platNum,  2, ',', '.') : '' }}</td>
            <td class="col-suma">{{ $platBanca!== null ? number_format($platBanca,2, ',', '.') : '' }}</td>
            <td class="col-deduct">{{ $entry->tip === 'plata' ? $entry->deductibilitate.'%' : '' }}</td>
        </tr>
        @endforeach

        @php
            $grandIncNum   += $mIncNum;
            $grandIncBanca += $mIncBanca;
            $grandPlatNum  += $mPlatNum;
            $grandPlatBanca+= $mPlatBanca;
        @endphp

        {{-- Total luna --}}
        <tr class="month-total">
            <td colspan="3" style="text-align:right;">TOTAL {{ strtoupper($luniRo[$luna]) }}</td>
            <td class="col-suma">{{ number_format($mIncNum,   2, ',', '.') }}</td>
            <td class="col-suma">{{ number_format($mIncBanca, 2, ',', '.') }}</td>
            <td class="col-suma">{{ number_format($mPlatNum,  2, ',', '.') }}</td>
            <td class="col-suma">{{ number_format($mPlatBanca,2, ',', '.') }}</td>
            <td></td>
        </tr>
    @endforeach

    {{-- Grand total --}}
    <tr class="grand-total">
        <td colspan="3" style="text-align:right;">TOTAL</td>
        <td class="col-suma">{{ number_format($grandIncNum,   2, ',', '.') }}</td>
        <td class="col-suma">{{ number_format($grandIncBanca, 2, ',', '.') }}</td>
        <td class="col-suma">{{ number_format($grandPlatNum,  2, ',', '.') }}</td>
        <td class="col-suma">{{ number_format($grandPlatBanca,2, ',', '.') }}</td>
        <td></td>
    </tr>
    </tbody>
</table>

@php
    $totalIncasari = $grandIncNum + $grandIncBanca;
    $totalPlati    = $grandPlatNum + $grandPlatBanca;
    $sold          = $totalIncasari - $totalPlati;
@endphp

<table class="summary-table">
    <tr>
        <td class="label">Total incasari:</td>
        <td class="value">{{ number_format($totalIncasari, 2, ',', '.') }} RON</td>
    </tr>
    <tr>
        <td class="label">Total plati:</td>
        <td class="value">{{ number_format($totalPlati, 2, ',', '.') }} RON</td>
    </tr>
    <tr>
        <td class="label">Sold:</td>
        <td class="value" style="font-weight:bold;">{{ number_format($sold, 2, ',', '.') }} RON</td>
    </tr>
</table>

</body>
</html>
