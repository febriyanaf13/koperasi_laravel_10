<?php

namespace App\Helpers;

class FormatHelper
{
    public static function formatRupiah($value)
    {
        return 'Rp ' . number_format($value, 0, ',', '.');
    }

    public static function formatRupiahToInt($formattedValue)
    {
        // Menghapus karakter 'Rp ', spasi, titik, dan koma dari nilai yang diformat
        $cleanedValue = preg_replace('/[^\d]/', '', $formattedValue);

        // Mengembalikan nilai sebagai integer
        return (int)$cleanedValue;
    }

}
