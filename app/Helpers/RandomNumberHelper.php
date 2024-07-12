<?php

namespace App\Helpers;

class RandomNumberHelper
{
    public static function generateRandomNumber($length = 16)
    {
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= random_int(0, 9);
        }
        return $result;
    }
}
