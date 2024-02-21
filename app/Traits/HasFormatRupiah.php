<?php

namespace App\Traits;

trait HasFormatRupiah
{
    function formatRupiah($field, $prefix = null)
    {
        $prefix = $prefix ? $prefix : 'IDR ';
        $nominal = $this->attributes[$field];
        return $prefix . number_format($nominal, 0, ',', '.');
    }
}
