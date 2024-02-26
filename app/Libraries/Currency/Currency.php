<?php

namespace App\Libraries\Currency;

class Currency
{
    function rupiah($angka){
        $hasil = "Rp " . number_format($angka,0,',','.');
        return $hasil;
    }
}
