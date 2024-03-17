<?php

namespace App\Traits;

trait SkuGenerator
{
    private function generateUniqueSku() {
        $timestamp = round(microtime(true) * 1000);
        $random = mt_rand();
        $unique_string = strtoupper(base_convert($timestamp + $random, 10, 36));
        $sku = substr($unique_string, 0, 10);
        return $sku;
    }
}