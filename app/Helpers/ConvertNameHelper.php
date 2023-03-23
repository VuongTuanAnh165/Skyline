<?php

namespace App\Helpers;
use Illuminate\Support\Str;

class ConvertNameHelper
{
    /**
     * Get File Extension
     * @param $name
     * @param $request
     * @return string
     */
    public static function convertName($text, string $divider = '-')
    {
        return Str::slug($text, $divider);
    }

    /**
     * Escape string in query like
     *
     * @param String $string
     * @return string
     */
    public static function escapeLike($string): string
    {
        $arySearch = array('\\', '%', '_');
        $aryReplace = array('\\\\', '\%', '\_');
        return str_replace($arySearch, $aryReplace, $string);
    }
}
