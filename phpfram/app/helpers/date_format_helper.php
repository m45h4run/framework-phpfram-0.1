<?php

if (!function_exists('format_indo')) {
    function format_indo($tanggal) {
        $bulan = array(
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $split = explode('-', $tanggal);
        $tgl = (int)$split[2];
        $bln = (int)$split[1];
        $thn = $split[0];
        return $tgl . ' ' . $bulan[$bln] . ' ' . $thn;
    }
}