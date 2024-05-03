<?php
function selisih($jam_in, $jam_out)
{
    list($h, $m) = explode(":", $jam_in); // Hanya menerima jam dan menit
    $dtAwal = mktime($h, $m, 0, 1, 1, 1); // Mengabaikan detik, mengatur detik ke 0
    list($h, $m) = explode(":", $jam_out); // Hanya menerima jam dan menit
    $dtAkhir = mktime($h, $m, 0, 1, 1, 1); // Mengabaikan detik, mengatur detik ke 0
    $dtSelisih = $dtAkhir - $dtAwal; // Menghitung selisih waktu tanpa detik
    $totalmenit = $dtSelisih / 60; // Konversi ke total menit
    $jam = (int)($totalmenit / 60); // Hitung jam tanpa sisa menit
    $sisamenit = $totalmenit % 60; // Hitung sisa menit
    return $jam . ":" . round($sisamenit); // Mengembalikan hasil tanpa detik
}
