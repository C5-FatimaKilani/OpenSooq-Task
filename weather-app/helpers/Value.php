<?php


namespace app\helpers;

class Value
{
    public static function not_empty($value, $key)
    {
        return isset($value[$key]) && !empty($value[$key]);
    }
}