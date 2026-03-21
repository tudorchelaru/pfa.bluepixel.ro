<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoxanaDataSeeder extends Seeder
{
    public function run(): void
    {
        $userId = 4; // roxana

        $entries = [
            // ========== IANUARIE ==========
            ['2024-01-09', 'incasare', 'numerar', 2000.00,  'CHITANTA NR. 1180',                              null,      100],
            ['2024-01-10', 'plata',    'numerar', 16.00,    'BAROU IASI - CHITANTA BARIM/10284',              'diverse', 100],
            ['2024-01-12', 'plata',    'numerar', 675.16,   'INTER BROKER (RCA AUTO) - CHITANTA AS/11326376', 'diverse', 100],
            ['2024-01-15', 'plata',    'numerar', 1350.00,  'PLUMBU SERGIU S. - CHITANTA (CHIRIE)',           'diverse', 100],
            ['2024-01-16', 'incasare', 'banca',   4655.45,  'CATALIN NICUSOR CIOATA',                         null,      100],
            ['2024-01-25', 'plata',    'numerar', 284.60,   'A. P. SCALA - BON FISC.',                        'diverse', 100],
            ['2024-01-25', 'incasare', 'numerar', 4000.00,  'CHITANTA NR. 1181',                              null,      100],
            ['2024-01-26', 'plata',    'numerar', 300.00,   'A. P. SCALA - BON FISC.',                        'diverse', 100],
            ['2024-01-26', 'plata',    'numerar', 1547.00,  'CAAR IASI - CHITANTA NR. 539',                   'diverse', 100],
            ['2024-01-26', 'plata',    'numerar', 160.00,   'BAROU IASI - CHITANTA ISCOTE/81925',             'diverse', 100],
            ['2024-01-30', 'incasare', 'numerar', 2500.00,  'CHITANTA NR. 1182',                              null,      100],
            ['2024-01-31', 'incasare', 'numerar', 600.00,   'CHITANTA NR. 1183',                              null,      100],
            ['2024-01-31', 'incasare', 'numerar', 3500.00,  'CHITANTA NR. 1184',                              null,      100],

            // ========== FEBRUARIE ==========
            ['2024-02-05', 'plata',    'numerar', 31.32,    'H20 CLEAN RO SRL - BON FISC. (VODAF.)',          'diverse', 100],
            ['2024-02-06', 'plata',    'numerar', 74.99,    'LUKOIL ROMANIA SRL - BON FISC.',                 'diverse', 100],
            ['2024-02-06', 'incasare', 'numerar', 1146.60,  'CHITANTA NR. 1185',                              null,      100],
            ['2024-02-07', 'plata',    'numerar', 9.50,     'C.N. PSTA ROMANA S.A. - FAC./CHIT.',             'diverse', 100],
            ['2024-02-15', 'plata',    'numerar', 1350.00,  'PLUMBU SERGIU S. - CHITANTA (CHIRIE)',           'diverse', 100],
            ['2024-02-15', 'incasare', 'numerar', 2500.00,  'CHITANTA NR. 1186',                              null,      100],
            ['2024-02-15', 'incasare', 'numerar', 2500.00,  'CHITANTA NR. 1187',                              null,      100],
            ['2024-02-15', 'incasare', 'numerar', 2000.00,  'CHITANTA NR. 1188',                              null,      100],
            ['2024-02-20', 'plata',    'numerar', 401.35,   'A. P. SCALA - BON FISC.',                        'diverse', 100],
            ['2024-02-24', 'plata',    'banca',   130.41,   'LUKOIL ROMANIA SRL - BON FISC.',                 'diverse', 100],
            ['2024-02-28', 'plata',    'numerar', 1560.00,  'CAAR IASI - CHITANTA NR. 1635',                  'diverse', 100],
            ['2024-02-28', 'plata',    'numerar', 80.00,    'BAROU IASI - CHITANTA ISCOTE/82587',             'diverse', 100],
            ['2024-02-29', 'incasare', 'banca',   499.80,   'BAROU IASI - INCASARI OFICII',                   null,      100],

            // ========== MARTIE ==========
            ['2024-03-04', 'incasare', 'numerar', 3500.00,  'CHITANTA NR. 1189',                              null,      100],
            ['2024-03-15', 'plata',    'numerar', 1350.00,  'PLUMBU SERGIU S. - CHITANTA (CHIRIE)',           'diverse', 100],
            ['2024-03-20', 'plata',    'numerar', 332.01,   'A. P. SCALA - BON FISC.',                        'diverse', 100],
            ['2024-03-26', 'plata',    'numerar', 350.00,   'A. P. SCALA - BON FISC.',                        'diverse', 100],
            ['2024-03-28', 'incasare', 'numerar', 1492.54,  'CHITANTA NR. 1190',                              null,      100],
            ['2024-03-28', 'incasare', 'numerar', 1000.00,  'CHITANTA NR. 1191',                              null,      100],

            // ========== APRILIE ==========
            ['2024-04-05', 'incasare', 'numerar', 2500.00,  'CHITANTA NR. 1192',                              null,      100],
            ['2024-04-05', 'incasare', 'numerar', 2000.00,  'CHITANTA NR. 1193',                              null,      100],
            ['2024-04-10', 'incasare', 'numerar', 5500.00,  'CHITANTA NR. 1194',                              null,      100],
            ['2024-04-15', 'plata',    'numerar', 34.61,    'H2O CLEAN RO SRL - BON FISC. (VODAF.)',          'diverse', 100],
            ['2024-04-15', 'plata',    'numerar', 1350.00,  'PLUMBU SERGIU S. - CHITANTA (CHIRIE)',           'diverse', 100],
            ['2024-04-22', 'plata',    'numerar', 776.00,   'CAAR IASI - CHITANTA NR. 2817',                  'diverse', 100],
            ['2024-04-22', 'plata',    'numerar', 80.00,    'BAROU IASI - CHITANTA ISCOTE/83351',             'diverse', 100],
            ['2024-04-24', 'incasare', 'banca',   1922.76,  'BAROU IASI - INCASARI OFICII',                   null,      100],
            ['2024-04-25', 'plata',    'numerar', 1638.00,  'CAAR IASI - CHITANTA NR. 3082',                  'diverse', 100],
            ['2024-04-25', 'plata',    'numerar', 16.00,    'BAROU IASI - CHITANTA BARIM/10571',              'diverse', 100],
            ['2024-04-25', 'plata',    'numerar', 80.00,    'BAROU IASI - CHITANTA ISCOTE/83534',             'diverse', 100],
            ['2024-04-25', 'incasare', 'numerar', 5000.00,  'CHITANTA NR. 1197',                              null,      100],
            ['2024-04-25', 'incasare', 'numerar', 2000.00,  'CHITANTA NR. 1198',                              null,      100],
            ['2024-04-29', 'incasare', 'numerar', 2000.00,  'CHITANTA NR. 1199',                              null,      100],
            ['2024-04-30', 'incasare', 'banca',   3000.00,  'IONUT MORUN',                                    null,      100],

            // ========== MAI ==========
            ['2024-05-12', 'plata',    'banca',   16.42,    'OMV PETROM MARKETING SRL - BON FISC.',           'diverse', 100],
            ['2024-05-13', 'incasare', 'numerar', 1500.00,  'CHITANTA NR. 1200',                              null,      100],
            ['2024-05-15', 'plata',    'numerar', 1350.00,  'PLUMBU SERGIU S. - CHITANTA (CHIRIE)',           'diverse', 100],
            ['2024-05-15', 'incasare', 'numerar', 500.00,   'CHITANTA NR. 1201',                              null,      100],
            ['2024-05-16', 'plata',    'banca',   146.81,   'OMV PETROM MARKETING SRL - BON FISC.',           'diverse', 100],
            ['2024-05-24', 'plata',    'numerar', 1498.00,  'CAAR IASI - CHITANTA NR. 3746',                  'diverse', 100],
            ['2024-05-24', 'plata',    'numerar', 80.00,    'BAROU IASI - CHITANTA ISCOTE/83964',             'diverse', 100],

            // ========== IUNIE ==========
            ['2024-06-07', 'incasare', 'banca',   3377.08,  'BAROU IASI - OFICII',                            null,      100],
            ['2024-06-15', 'plata',    'numerar', 1350.00,  'PLUMBU SERGIU S. - CHITANTA (CHIRIE)',           'diverse', 100],
            ['2024-06-17', 'plata',    'numerar', 33.09,    'H20 CLEAN RO SRL - BON FISC. (VODAF.)',          'diverse', 100],
            ['2024-06-17', 'plata',    'banca',   69.00,    'SC REFILL HOUSE COMPANY SRL - BON FISC.',        'diverse', 100],
            ['2024-06-26', 'plata',    'numerar', 1106.00,  'CAAR IASI - CHITANTA NR. 4702',                  'diverse', 100],
            ['2024-06-26', 'plata',    'numerar', 80.00,    'BAROU IASI - CHITANTA ISCOTE/84593',             'diverse', 100],

            // ========== IULIE ==========
            ['2024-07-01', 'incasare', 'numerar', 5000.00,  'CHITANTA NR. 1211',                              null,      100],
            ['2024-07-03', 'plata',    'numerar', 700.00,   'A. P. SCALA - BON FISC.',                        'diverse', 100],
            ['2024-07-08', 'plata',    'numerar', 35.82,    'H20 CLEAN RO SRL - BON FISC. (VODAF.)',          'diverse', 100],
            ['2024-07-15', 'plata',    'numerar', 1350.00,  'PLUMBU SERGIU S. - CHITANTA (CHIRIE)',           'diverse', 100],
            ['2024-07-22', 'plata',    'numerar', 987.14,   'INTER BROKER (RCA AUTO) - CHITANTA AS/11620936', 'diverse', 100],
            ['2024-07-29', 'incasare', 'numerar', 2500.00,  'CHITANTA NR. 1202',                              null,      100],
            ['2024-07-29', 'incasare', 'numerar', 2500.00,  'CHITANTA NR. 1203',                              null,      100],
            ['2024-07-31', 'incasare', 'numerar', 1500.00,  'CHITANTA NR. 1204',                              null,      100],
            ['2024-07-31', 'incasare', 'numerar', 3500.00,  'CHITANTA NR. 1205',                              null,      100],

            // ========== AUGUST ==========
            ['2024-08-07', 'plata',    'numerar', 50.24,    'OMV PETROM MARKETING SRL - BON FISC.',           'diverse', 100],
            ['2024-08-15', 'plata',    'numerar', 1350.00,  'PLUMBU SERGIU S. - CHITANTA (CHIRIE)',           'diverse', 100],
            ['2024-08-16', 'plata',    'banca',   34.46,    'H20 CLEAN RO SRL - BON FISC. (VODAF.)',          'diverse', 100],
            ['2024-08-21', 'plata',    'banca',   103.04,   'OMV PETROM MARKETING SRL - BON FISC.',           'diverse', 100],
            ['2024-08-21', 'plata',    'numerar', 574.00,   'A. P. SCALA - BON FISC.',                        'diverse', 100],
            ['2024-08-21', 'plata',    'numerar', 326.00,   'A. P. SCALA - BON FISC.',                        'diverse', 100],
            ['2024-08-26', 'plata',    'numerar', 100.53,   'OMV PETROM MARKETING SRL - BON FISC.',           'diverse', 100],
            ['2024-08-28', 'plata',    'numerar', 290.00,   'A. P. SCALA - BON FISC.',                        'diverse', 100],
            ['2024-08-29', 'plata',    'numerar', 50.09,    'MOL ROMANIA PETROLEUM PRODUCTS SRL - BON FISC.', 'diverse', 100],
            ['2024-08-30', 'plata',    'numerar', 16.42,    'MOL ROMANIA PETROLEUM PRODUCTS SRL - BON FISC.', 'diverse', 100],
            ['2024-08-30', 'plata',    'numerar', 75.04,    'OMV PETROM MARKETING SRL - BON FISC.',           'diverse', 100],

            // ========== SEPTEMBRIE ==========
            ['2024-09-03', 'plata',    'numerar', 273.00,   'CAAR IASI - CHITANTA NR. 6344',                  'diverse', 100],
            ['2024-09-03', 'plata',    'numerar', 169.00,   'BAROU IASI - CHITANTA ISCOTE/85692',             'diverse', 100],
            ['2024-09-04', 'plata',    'numerar', 100.00,   'ROMPETROL DOWNSTREAM SRL - BON FISC.',           'diverse', 100],
            ['2024-09-04', 'plata',    'numerar', 9.50,     'C.N. POSTA ROMANA S.A. - FAC./CHIT.',            'diverse', 100],
            ['2024-09-04', 'plata',    'numerar', 128.00,   'SC AUTO ELIT MOLDOVA SRL - BON FISC./FACT.',     'diverse', 100],
            ['2024-09-09', 'plata',    'banca',   53.72,    'H20 CLEAN RO SRL - BON FISC. (VODAF.)',          'diverse', 100],
            ['2024-09-15', 'plata',    'numerar', 1350.00,  'PLUMBU SERGIU S. - CHITANTA (CHIRIE)',           'diverse', 100],
            ['2024-09-16', 'incasare', 'numerar', 1500.00,  'CHITANTA NR. 1206',                              null,      100],
            ['2024-09-20', 'incasare', 'numerar', 5000.00,  'CHITANTA NR. 1207',                              null,      100],
            ['2024-09-23', 'incasare', 'numerar', 5000.00,  'CHITANTA NR. 1208',                              null,      100],
            ['2024-09-30', 'plata',    'numerar', 100.22,   'LUKOIL ROMANIA SRL - BON FISC.',                 'diverse', 100],
            ['2024-09-30', 'incasare', 'numerar', 1000.00,  'CHITANTA NR. 1210',                              null,      100],

            // ========== OCTOMBRIE ==========
            ['2024-10-05', 'plata',    'numerar', 34.71,    'H20 CLEAN RO SRL - BON FISC. (VODAF.)',          'diverse', 100],
            ['2024-10-10', 'incasare', 'banca',   2714.60,  'BAROU IASI - OFICII',                            null,      100],
            ['2024-10-15', 'plata',    'numerar', 1350.00,  'PLUMBU SERGIU S. - CHITANTA (CHIRIE)',           'diverse', 100],
            ['2024-10-24', 'plata',    'numerar', 149.20,   'INTER BROKER (MAL PRAXIS) - CHITANTA AS/11725270', 'diverse', 100],
            ['2024-10-28', 'plata',    'numerar', 1072.00,  'CAAR IASI - CHITANTA NR. 7234',                  'diverse', 100],
            ['2024-10-28', 'plata',    'numerar', 178.00,   'BAROU IASI - CHITANTA ISCOTE/86623',             'diverse', 100],
            ['2024-10-28', 'plata',    'numerar', 32.00,    'BAROU IASI - CHITANTA BARIM/10984',              'diverse', 100],
            ['2024-10-29', 'plata',    'banca',   32.50,    'SC SEDCOM LIBRIS SA - BON FISC.',                'diverse', 100],
            ['2024-10-30', 'incasare', 'numerar', 5000.00,  'CHITANTA NR. 1209',                              null,      100],

            // ========== NOIEMBRIE ==========
            ['2024-11-01', 'plata',    'banca',   139.29,   'OMV PETROM MARKETING SRL - BON FISC.',           'diverse', 100],
            ['2024-11-01', 'incasare', 'numerar', 4000.00,  'CHITANTA NR. 1213',                              null,      100],
            ['2024-11-07', 'plata',    'banca',   800.00,   'JYSK ROMANIA SRL - BON FISC.',                   'diverse', 100],
            ['2024-11-07', 'incasare', 'banca',   3500.00,  'BOGDAN CATALIN SPIRIDON',                        null,      100],
            ['2024-11-11', 'plata',    'numerar', 34.70,    'H20 CLEAN RO SRL - BON FISC. (VODAF.)',          'diverse', 100],
            ['2024-11-15', 'plata',    'numerar', 1350.00,  'PLUMBU SERGIU S. - CHITANTA (CHIRIE)',           'diverse', 100],
            ['2024-11-15', 'incasare', 'numerar', 10780.00, 'CHITANTA NR. 1214',                              null,      100],
            ['2024-11-18', 'incasare', 'numerar', 666.40,   'CHITANTA NR. 1212',                              null,      100],
            ['2024-11-19', 'incasare', 'banca',   3500.00,  'PAROHIA GOLAIESTI',                              null,      100],
            ['2024-11-20', 'plata',    'banca',   100.03,   'LUKOIL ROMANIA SRL - BON FISC.',                 'diverse', 100],
            ['2024-11-26', 'plata',    'numerar', 1400.00,  'CAAR IASI - CHITANTA NR. 8097',                  'diverse', 100],
            ['2024-11-26', 'plata',    'numerar', 109.00,   'BAROU IASI - CHITANTA ISCOTE/87164',             'diverse', 100],

            // ========== DECEMBRIE ==========
            ['2024-12-10', 'plata',    'numerar', 40.08,    'H20 CLEAN RO SRL - BON FISC. (VODAF.)',          'diverse', 100],
            ['2024-12-15', 'plata',    'numerar', 1350.00,  'PLUMBU SERGIU S. - CHITANTA (CHIRIE)',           'diverse', 100],
            ['2024-12-22', 'plata',    'banca',   100.89,   'LUKOIL ROMANIA SRL - BON FISC.',                 'diverse', 100],
        ];

        $now = now();
        $rows = [];

        foreach ($entries as $e) {
            [$data, $tip, $metoda, $suma, $document, $tip_cheltuiala, $deductibilitate] = $e;

            if ($tip === 'incasare') {
                $tip_cheltuiala = null;
                $deductibilitate = 100;
            }

            $rows[] = [
                'user_id'         => $userId,
                'data'            => $data,
                'tip'             => $tip,
                'metoda'          => $metoda,
                'suma'            => $suma,
                'valuta'          => 'RON',
                'document'        => $document,
                'tip_cheltuiala'  => $tip_cheltuiala,
                'deductibilitate' => $deductibilitate,
                'created_at'      => $now,
                'updated_at'      => $now,
            ];
        }

        DB::table('registru_entries')->insert($rows);

        $this->command->info('Importate ' . count($rows) . ' inregistrari pentru roxana (user_id=4).');
    }
}
