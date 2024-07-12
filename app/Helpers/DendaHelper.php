<?php

namespace App\Helpers;

use Carbon\Carbon;

class DendaHelper
{

    public static function hitungDenda($angsuranPerBulan, $bunga, $tanggalJatuhTempo)
    {
        // Konversi tanggal jatuh tempo ke objek Carbon
        $tanggalJatuhTempo = Carbon::parse($tanggalJatuhTempo);
        // Dapatkan tanggal hari ini
        $hariIni = Carbon::now();

        // Periksa apakah hari ini sudah melewati tanggal jatuh tempo
        if ($hariIni->greaterThan($tanggalJatuhTempo)) {
            // Hitung jumlah hari keterlambatan
            $jumlahHariTerlambat = $hariIni->diffInDays($tanggalJatuhTempo);
            // Hitung denda (misalnya, 1% dari angsuran per hari keterlambatan)
            $dendaPerHari = ($bunga / 100) * $angsuranPerBulan;
            $denda = $jumlahHariTerlambat * $dendaPerHari;
            return $denda;
        } else {
            // Jika belum melewati jatuh tempo, denda adalah 0
            return 0;
        }
    }

}
