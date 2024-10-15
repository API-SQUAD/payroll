<?php

if (!function_exists('removeRibuanFormat')) {
    function removeRibuanFormat($value)
    {
        return str_replace('.', '', $value);
    }
}
