<?php

namespace App\Helpers;

class ArrayHelper 
{
    public static function containsOnlyNull(array $array): bool
    {
        return empty(array_filter($array, function ($a) { return $a !== null;}));
    }
}
