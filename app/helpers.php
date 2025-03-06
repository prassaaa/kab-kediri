<?php

if (!function_exists('str_slug')) {
    function str_slug($string)
    {
        return \Illuminate\Support\Str::slug($string);
    }
}