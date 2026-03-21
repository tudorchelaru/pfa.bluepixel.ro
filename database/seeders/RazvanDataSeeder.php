<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RazvanDataSeeder extends Seeder
{
    public function run(): void
    {
        $userId = 2; // razvan

        $entries = [
            // ========== IANUARIE ==========
            ['2024-01-10', 'plata',    'numerar', 106.85,   'RCS&RDS SA - BON FISC.',              'diverse',      100],
            ['2024-01-15', 'plata',    'numerar', 1350.00,  'PLUMBU SERGIU S. - CHIT.(CHIRIE)',    'diverse',      100],
            ['2024-01-18', 'plata',    'banca',   1500.00,  'UNICREDIT LEASING - RATA',            'rata_leasing', 100],
            ['2024-01-26', 'plata',    'numerar', 300.00,   'A.P. SCALA - CHITANTA 00006211',      'diverse',      100],
            ['2024-01-29', 'incasare', 'numerar', 250.00,   'CHITANTA NR. 005',                    null,           100],

            // ========== FEBRUARIE ==========
            ['2024-02-05', 'incasare', 'numerar', 4000.00,  'CHITANTA NR. 006',                    null,           100],
            ['2024-02-06', 'incasare', 'numerar', 1589.56,  'CHITANTA NR. 007',                    null,           100],
            ['2024-02-06', 'incasare', 'numerar', 800.00,   'CHITANTA NR. 008',                    null,           100],
            ['2024-02-06', 'incasare', 'numerar', 800.00,   'CHITANTA NR. 009',                    null,           100],
            ['2024-02-06', 'incasare', 'numerar', 800.00,   'CHITANTA NR. 011',                    null,           100],
            ['2024-02-06', 'incasare', 'numerar', 800.00,   'CHITANTA NR. 012',                    null,           100],
            ['2024-02-06', 'incasare', 'numerar', 800.00,   'CHITANTA NR. 013',                    null,           100],
            ['2024-02-13', 'incasare', 'numerar', 500.00,   'CHITANTA NR. 014',                    null,           100],
            ['2024-02-14', 'incasare', 'banca',   500.00,   'LEPADATU MARIUS',                     null,           100],
            ['2024-02-14', 'incasare', 'numerar', 2500.00,  'CHITANTA NR. 015',                    null,           100],
            ['2024-02-15', 'plata',    'numerar', 1350.00,  'PLUMBU SERGIU S. - CHIT.(CHIRIE)',    'diverse',      100],
            ['2024-02-15', 'incasare', 'numerar', 450.00,   'CHITANTA NR. 016',                    null,           100],
            ['2024-02-16', 'plata',    'banca',   1500.00,  'UNICREDIT LEASING',                   'rata_leasing', 100],
            ['2024-02-16', 'incasare', 'banca',   12.00,    'OVI VAI KI GROUP SRL',                null,           100],
            ['2024-02-21', 'plata',    'banca',   521.64,   'EBAS P.S. SRL(PROG. LEGISLATIE)',     'diverse',      100],
            ['2024-02-27', 'plata',    'numerar', 36.60,    'BON PIM SRL',                         'diverse',      100],
            ['2024-02-27', 'plata',    'banca',   151.80,   'PIM SRL - bon. fisc.',                'diverse',      100],

            // ========== MARTIE ==========
            ['2024-03-11', 'incasare', 'numerar', 250.00,   'CHITANTA NR. 017',                    null,           100],
            ['2024-03-13', 'plata',    'numerar', 300.00,   'BON BNP FLOREA BOGDAN-DANIEL',        'diverse',      100],
            ['2024-03-15', 'plata',    'banca',   280.00,   'TRIPACO SRL - BON FISC.',             'diverse',      100],
            ['2024-03-15', 'plata',    'numerar', 1350.00,  'PLUMBU SERGIU S. - CHIT.(CHIRIE)',    'diverse',      100],
            ['2024-03-21', 'plata',    'numerar', 106.95,   'RCS&RDS SA - BON FISC.',              'diverse',      100],
            ['2024-03-21', 'plata',    'banca',   1500.00,  'UNICREDIT LEASING CORP IFN SA',       'rata_leasing', 100],
            ['2024-03-25', 'plata',    'numerar', 2399.65,  'APAN MOTORS SRL - BON FISC./FACT.',   'diverse',      100],
            ['2024-03-25', 'incasare', 'numerar', 750.00,   'CHITANTA NR. 018',                    null,           100],
            ['2024-03-26', 'plata',    'numerar', 350.00,   'A.P. SCALA - CHITANTA 00006500',      'diverse',      100],
            ['2024-03-27', 'incasare', 'numerar', 5000.00,  'CHITANTA NR. 019',                    null,           100],

            // ========== APRILIE ==========
            ['2024-04-03', 'incasare', 'banca',   600.00,   'DIUTA TOMA IONUT',                    null,           100],
            ['2024-04-03', 'incasare', 'banca',   300.00,   'MESNITA ROXANA ADRIANA',              null,           100],
            ['2024-04-03', 'incasare', 'numerar', 250.00,   'CHITANTA NR. 020',                    null,           100],
            ['2024-04-03', 'incasare', 'numerar', 600.00,   'CHITANTA NR. 021',                    null,           100],
            ['2024-04-03', 'incasare', 'numerar', 600.00,   'CHITANTA NR. 022',                    null,           100],
            ['2024-04-04', 'incasare', 'banca',   300.00,   'MESNITA OANA RODICA',                 null,           100],
            ['2024-04-04', 'plata',    'banca',   528.10,   'EON MYLINE',                          'diverse',      100],
            ['2024-04-08', 'plata',    'numerar', 180.00,   'BON BNP FLOREA BOGDAN-DANIEL',        'diverse',      100],
            ['2024-04-09', 'incasare', 'banca',   5000.00,  'OVI VAI KI GROUP SRL',                null,           100],
            ['2024-04-10', 'incasare', 'numerar', 600.00,   'CHITANTA NR. 023',                    null,           100],
            ['2024-04-11', 'plata',    'numerar', 495.00,   'APAN MOTORS SRL - BON FISC./FACT.',   'diverse',      100],
            ['2024-04-15', 'plata',    'numerar', 1350.00,  'PLUMBU SERGIU S. - CHIT.(CHIRIE)',    'diverse',      100],
            ['2024-04-15', 'plata',    'banca',   1500.00,  'UNICREDIT LEASING CORP IFN SA',       'rata_leasing', 100],
            ['2024-04-18', 'incasare', 'banca',   700.00,   'SIND. BCU',                           null,           100],
            ['2024-04-22', 'incasare', 'banca',   2500.00,  'COM STANILESTI',                      null,           100],
            ['2024-04-23', 'plata',    'numerar', 3360.28,  'APAN MOTORS SRL - BON FISC./FACT.',   'diverse',      100],
            ['2024-04-23', 'incasare', 'banca',   5000.00,  'COJOCARU IONEL DANIEL',               null,           100],
            ['2024-04-24', 'incasare', 'banca',   1452.36,  'BAROUL IASI - OFICII',                null,           100],
            ['2024-04-25', 'incasare', 'numerar', 5000.00,  'CHITANTA NR. 024',                    null,           100],
            ['2024-04-25', 'incasare', 'numerar', 2000.00,  'CHITANTA NR. 025',                    null,           100],
            ['2024-04-29', 'incasare', 'banca',   10000.00, 'OVI VAI KI GROUP SRL',                null,           100],
            ['2024-04-30', 'incasare', 'numerar', 2500.00,  'CHITANTA NR. 026',                    null,           100],

            // ========== MAI ==========
            ['2024-05-08', 'incasare', 'numerar', 700.00,   'CHITANTA NR. 027',                    null,           100],
            ['2024-05-13', 'incasare', 'numerar', 3700.00,  'CHITANTA NR. 028',                    null,           100],
            ['2024-05-14', 'plata',    'banca',   1500.00,  'UNICREDIT LEASING CORP IFN SA',       'rata_leasing', 100],
            ['2024-05-15', 'plata',    'numerar', 1350.00,  'PLUMBU SERGIU S. - CHIT.(CHIRIE)',    'diverse',      100],
            ['2024-05-23', 'incasare', 'numerar', 4500.00,  'CHITANTA NR. 029',                    null,           100],
            ['2024-05-23', 'incasare', 'numerar', 4500.00,  'CHITANTA NR. 030',                    null,           100],

            // ========== IUNIE ==========
            ['2024-06-02', 'plata',    'numerar', 100.05,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],
            ['2024-06-03', 'incasare', 'banca',   3689.84,  'NEAGU DORINA DIANA',                  null,           100],
            ['2024-06-06', 'plata',    'numerar', 100.00,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],
            ['2024-06-07', 'incasare', 'banca',   2589.16,  'BAROUL IASI - OFICII',                null,           100],
            ['2024-06-09', 'plata',    'numerar', 200.07,   'OMV PETROM MARK. SRL - BON FISC.',    'diverse',      100],
            ['2024-06-11', 'plata',    'numerar', 200.30,   'OMV PETROM MARK. SRL - BON FISC.',    'diverse',      100],
            ['2024-06-15', 'plata',    'numerar', 1350.00,  'PLUMBU SERGIU S. - CHIT.(CHIRIE)',    'diverse',      100],
            ['2024-06-17', 'plata',    'banca',   1500.00,  'UNICREDIT LEASING CORP IFN SA',       'rata_leasing', 100],
            ['2024-06-18', 'plata',    'numerar', 200.05,   'OMV PETROM MARK. SRL - BON FISC.',    'diverse',      100],
            ['2024-06-19', 'plata',    'numerar', 105.00,   'ONOSERACT SRL - BON FISC.',           'diverse',      100],
            ['2024-06-21', 'plata',    'numerar', 180.00,   'BNP FLOREA BOGDAN - BON',             'diverse',      100],
            ['2024-06-24', 'plata',    'numerar', 200.47,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],
            ['2024-06-26', 'plata',    'numerar', 80.00,    'BAROUL IASI - CHITANTA ISCOTE/84594/26.06.2024', 'diverse', 100],
            ['2024-06-26', 'plata',    'numerar', 16.00,    'BAORUL IASI - CHIT.BARIM/10704',      'diverse',      100],
            ['2024-06-26', 'plata',    'numerar', 1680.00,  'CAAR IASI - CHIT.4704/26.06.2024',    'diverse',      100],

            // ========== IULIE ==========
            ['2024-07-02', 'incasare', 'numerar', 4000.00,  'CHITANTA NR. 031',                    null,           100],
            ['2024-07-03', 'plata',    'numerar', 200.33,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],
            ['2024-07-03', 'plata',    'numerar', 700.00,   'A.P. SCALA - CHITANTA PV 341',        'diverse',      100],
            ['2024-07-04', 'incasare', 'banca',   250.00,   'KARACHI HAITHAM',                     null,           100],
            ['2024-07-04', 'incasare', 'banca',   343.35,   'HARAS DE LAUBRY NV',                  null,           100],
            ['2024-07-08', 'incasare', 'numerar', 2500.00,  'CHITANTA NR. 032',                    null,           100],
            ['2024-07-10', 'incasare', 'numerar', 3500.00,  'CHITANTA NR. 034',                    null,           100],
            ['2024-07-11', 'incasare', 'numerar', 2500.00,  'CHITANTA NR. 035',                    null,           100],
            ['2024-07-12', 'plata',    'banca',   1500.00,  'UNICREDIT LEASING CORP IFN SA',       'rata_leasing', 100],
            ['2024-07-13', 'plata',    'numerar', 100.02,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],
            ['2024-07-15', 'plata',    'numerar', 1350.00,  'PLUMBU SERGIU S. - CHIT.(CHIRIE)',    'diverse',      100],
            ['2024-07-22', 'incasare', 'numerar', 1500.00,  'CHITANTA NR. 036',                    null,           100],
            ['2024-07-23', 'plata',    'numerar', 110.00,   'DIGI ROMANIA SA - BON FISC.',         'diverse',      100],
            ['2024-07-25', 'plata',    'numerar', 200.97,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],
            ['2024-07-26', 'incasare', 'numerar', 1764.00,  'CHITANTA NR. 037',                    null,           100],
            ['2024-07-30', 'plata',    'numerar', 200.06,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],

            // ========== AUGUST ==========
            ['2024-08-08', 'incasare', 'numerar', 916.30,   'CHITANTA NR. 038',                    null,           100],
            ['2024-08-09', 'plata',    'numerar', 230.72,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],
            ['2024-08-12', 'incasare', 'numerar', 1000.00,  'CHITANTA NR. 039',                    null,           100],
            ['2024-08-15', 'plata',    'numerar', 1350.00,  'PLUMBU SERGIU S. - CHIT.(CHIRIE)',    'diverse',      100],
            ['2024-08-20', 'plata',    'numerar', 150.06,   'OMV PETROM MARK. SRL - BON FISC.',    'diverse',      100],
            ['2024-08-20', 'plata',    'banca',   720.00,   'BNP FLOREA BOGDAN - BON FISC.',       'diverse',      100],
            ['2024-08-20', 'incasare', 'banca',   1500.00,  'ECHO POLLO SRL',                      null,           100],
            ['2024-08-21', 'plata',    'numerar', 175.00,   'ONOSERACT SRL - BON FISC.',           'diverse',      100],
            ['2024-08-21', 'plata',    'numerar', 350.00,   'ONOSERACT SRL - BON FISC.',           'diverse',      100],
            ['2024-08-21', 'plata',    'numerar', 574.00,   'A.P. SCALA - CHITANTA PV 432',        'diverse',      100],
            ['2024-08-21', 'plata',    'numerar', 326.00,   'A.P. SCALA - CHITANTA PV 431',        'diverse',      100],
            ['2024-08-21', 'incasare', 'banca',   500.00,   'ECHO POLLO SRL',                      null,           100],
            ['2024-08-23', 'incasare', 'banca',   5000.00,  'VIERU SERGIU',                        null,           100],
            ['2024-08-23', 'plata',    'banca',   1500.00,  'UNICREDIT LEASING CORP IFN SA',       'rata_leasing', 100],
            ['2024-08-28', 'plata',    'numerar', 92.13,    'DIGI ROMANIA SA - BON FISC.',         'diverse',      100],
            ['2024-08-28', 'plata',    'numerar', 290.00,   'A.P. SCALA - CHITANTA PV 450',        'diverse',      100],
            ['2024-08-28', 'incasare', 'numerar', 6474.00,  'CHITANTA NR. 040',                    null,           100],
            ['2024-08-30', 'incasare', 'numerar', 1000.00,  'CHITANTA NR. 041',                    null,           100],

            // ========== SEPTEMBRIE ==========
            ['2024-09-02', 'plata',    'numerar', 244.02,   'APAN MOTORS SRL - BON FISC.',         'diverse',      100],
            ['2024-09-02', 'plata',    'numerar', 1000.00,  'APAN MOTORS SRL - BON FISC./FACT.',   'diverse',      100],
            ['2024-09-02', 'plata',    'banca',   1500.00,  'UNICREDIT LEASING CORP IFN SA',       'rata_leasing', 100],
            ['2024-09-03', 'plata',    'numerar', 1072.00,  'CAAR IASI - CHIT.6341/03.09.2024',    'diverse',      100],
            ['2024-09-03', 'plata',    'numerar', 169.00,   'BAROUL IASI - CHIT. ISCOTE/85691',    'diverse',      100],
            ['2024-09-05', 'plata',    'numerar', 60.00,    'BNP FLOREA BOGDAN - BON FISC.',       'diverse',      100],
            ['2024-09-05', 'plata',    'numerar', 201.14,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],
            ['2024-09-08', 'plata',    'numerar', 35.32,    'PIM SRL - bon. fisc.',                'diverse',      100],
            ['2024-09-09', 'incasare', 'banca',   700.00,   'TIPAU RAZVAN-DUMITRU',                null,           100],
            ['2024-09-15', 'plata',    'numerar', 1350.00,  'PLUMBU SERGIU S. - CHIT.(CHIRIE)',    'diverse',      100],
            ['2024-09-19', 'plata',    'numerar', 120.00,   'BNP FLOREA BOGDAN - BON FISC.',       'diverse',      100],
            ['2024-09-19', 'plata',    'numerar', 100.99,   'DIGI ROMANIA SA - BON FISC.',         'diverse',      100],
            ['2024-09-19', 'incasare', 'numerar', 1500.00,  'CHITANTA NR. 042',                    null,           100],
            ['2024-09-21', 'plata',    'numerar', 200.23,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],
            ['2024-09-22', 'plata',    'numerar', 200.03,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],
            ['2024-09-25', 'plata',    'numerar', 200.00,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],
            ['2024-09-26', 'plata',    'numerar', 150.04,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],
            ['2024-09-27', 'plata',    'numerar', 200.03,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],
            ['2024-09-30', 'plata',    'numerar', 50.00,    'PIM SRL - BON',                       'diverse',      100],
            ['2024-09-30', 'incasare', 'numerar', 3000.00,  'CHITANTA NR. 043',                    null,           100],

            // ========== OCTOMBRIE ==========
            ['2024-10-01', 'incasare', 'numerar', 4000.00,  'CHITANTA NR. 044',                    null,           100],
            ['2024-10-02', 'plata',    'banca',   146.00,   'AUTO ELIT MOLDOVA SRL - BON FISC.',   'diverse',      100],
            ['2024-10-02', 'plata',    'numerar', 200.08,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],
            ['2024-10-02', 'plata',    'banca',   600.00,   'BNP FLOREA BOGDAN - BON FISC.',       'diverse',      100],
            ['2024-10-04', 'incasare', 'numerar', 3500.00,  'CHITANTA NR. 045',                    null,           100],
            ['2024-10-10', 'plata',    'numerar', 199.94,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],
            ['2024-10-10', 'incasare', 'banca',   791.84,   'BAROUL IASI - OFICII',                null,           100],
            ['2024-10-12', 'plata',    'numerar', 199.94,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],
            ['2024-10-13', 'plata',    'numerar', 200.03,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],
            ['2024-10-15', 'plata',    'numerar', 1350.00,  'PLUMBU SERGIU S. - CHIT.(CHIRIE)',    'diverse',      100],
            ['2024-10-22', 'incasare', 'banca',   1500.00,  'OLTITA AXINTE',                       null,           100],
            ['2024-10-22', 'plata',    'banca',   1500.00,  'UNICREDIT LEASING CORP IFN SA',       'rata_leasing', 100],
            ['2024-10-23', 'plata',    'numerar', 201.06,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],
            ['2024-10-23', 'plata',    'numerar', 300.00,   'BNP FLOREA BOGDAN - BON FISC.',       'diverse',      100],
            ['2024-10-23', 'incasare', 'numerar', 6500.00,  'CHITANTA NR. 046',                    null,           100],
            ['2024-10-24', 'plata',    'numerar', 149.20,   'INTER BROKER DE ASIGURARE(MAL PRAXIS)', 'diverse',    100],
            ['2024-10-27', 'incasare', 'banca',   1000.00,  'OVI VAI KI GROUP SRL',                null,           100],
            ['2024-10-28', 'plata',    'numerar', 240.00,   'BNP FLOREA BOGDAN - BON FISC.',       'diverse',      100],
            ['2024-10-28', 'plata',    'numerar', 1072.00,  'CAAR IASI - CHIT.7232/28.10.2024',    'diverse',      100],
            ['2024-10-28', 'plata',    'numerar', 178.00,   'BAROUL IASI - CHIT. ISCOTE/86622',    'diverse',      100],
            ['2024-10-28', 'incasare', 'banca',   500.00,   'MATRESCU SIMONA',                     null,           100],
            ['2024-10-29', 'plata',    'numerar', 73.94,    'H2O CLEAN RO SRL(VODAFONE) - BON FISC.', 'diverse',   100],
            ['2024-10-31', 'plata',    'numerar', 200.12,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],
            ['2024-10-31', 'incasare', 'banca',   8000.00,  'RAILEANU DOMNICA',                    null,           100],

            // ========== NOIEMBRIE ==========
            ['2024-11-07', 'plata',    'numerar', 241.41,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],
            ['2024-11-11', 'plata',    'banca',   1500.00,  'UNICREDIT LEASING CORP IFN SA',       'rata_leasing', 100],
            ['2024-11-12', 'incasare', 'banca',   1781.64,  'BAROUL IASI - OFICII',                null,           100],
            ['2024-11-13', 'plata',    'banca',   139.29,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],
            ['2024-11-15', 'plata',    'numerar', 200.00,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],
            ['2024-11-15', 'plata',    'numerar', 1350.00,  'PLUMBU SERGIU S. - CHIT.(CHIRIE)',    'diverse',      100],
            ['2024-11-19', 'plata',    'numerar', 101.06,   'DIGI ROMANIA SA - BON FISC.',         'diverse',      100],
            ['2024-11-19', 'incasare', 'banca',   8000.00,  'OVI VAI KI GROUP SRL',                null,           100],
            ['2024-11-20', 'plata',    'banca',   180.00,   'BNP FLOREA BOGDAN - BON FISC.',       'diverse',      100],
            ['2024-11-21', 'plata',    'banca',   99.80,    'MOL ROMANIA SRL - BON FISC.',         'diverse',      100],
            ['2024-11-22', 'incasare', 'banca',   800.00,   'SIND. BCU',                           null,           100],
            ['2024-11-24', 'plata',    'banca',   200.83,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],
            ['2024-11-26', 'plata',    'numerar', 109.00,   'BAROUL IASI - CHIT. ISCOTE/87163',    'diverse',      100],
            ['2024-11-26', 'plata',    'numerar', 536.00,   'CAAR IASI - CHIT.8095/26.11.2024',    'diverse',      100],
            ['2024-11-26', 'incasare', 'banca',   8600.00,  'ROSU DINAMIC CONSTRUCT SRL',          null,           100],
            ['2024-11-27', 'incasare', 'banca',   1500.00,  'ROSU DINAMIC CONSTRUCT SRL',          null,           100],
            ['2024-11-28', 'incasare', 'banca',   2000.00,  'ASCOR IASI',                          null,           100],

            // ========== DECEMBRIE ==========
            ['2024-12-02', 'incasare', 'banca',   3000.00,  'VIERU SERGIU',                        null,           100],
            ['2024-12-02', 'incasare', 'banca',   2000.00,  'VIERU SERGIU',                        null,           100],
            ['2024-12-03', 'plata',    'banca',   199.98,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],
            ['2024-12-05', 'plata',    'numerar', 101.04,   'DIGI ROMANIA SA - BON FISC.',         'diverse',      100],
            ['2024-12-12', 'plata',    'numerar', 199.99,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],
            ['2024-12-12', 'incasare', 'banca',   6000.00,  'ESKANDER LUMINITA',                   null,           100],
            ['2024-12-15', 'plata',    'numerar', 1350.00,  'PLUMBU SERGIU S. - CHIT.(CHIRIE)',    'diverse',      100],
            ['2024-12-20', 'incasare', 'banca',   2800.00,  'MIHAITA GHEORGHE',                    null,           100],
            ['2024-12-20', 'plata',    'banca',   1500.00,  'UNICREDIT LEASING CORP IFN SA',       'rata_leasing', 100],
            ['2024-12-21', 'plata',    'banca',   100.08,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],
            ['2024-12-28', 'plata',    'numerar', 100.00,   'OMV PETROM MARK SRL - BON FISC.',     'diverse',      100],
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

        $this->command->info('Importate ' . count($rows) . ' inregistrari pentru razvan (user_id=2).');
    }
}
