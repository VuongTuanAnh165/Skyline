<?php

namespace App\Helpers;

class UsdPriceHelper
{
    /**
     * Get File Extension
     * @param $name
     * @param $request
     * @return string
     */
    public static function usdPrice($price)
    {
        return round($price * 0.000043, 2);
    }
}
