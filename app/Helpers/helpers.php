<?php
use App\User;

/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/9/11
 * Time: 1:43
 */

if (!function_exists('isAdmin')) {
    function isAdmin(User $user)
    {
        return $user != null && $user->id == 1;
    }
}

if (!function_exists('array_safe_get')) {
    function array_safe_get($array, $key, $default = '')
    {
        if (array_has($array, $key)) {
            return $array[$key];
        }
        return $default;
    }
}

if (!function_exists('getUrlByFileName')) {
    function getUrlByFileName($fileName)
    {
        return 'https://static.lufficc.com/' . $fileName;
    }
}

if (!function_exists('formatBytes')) {
    function formatBytes($size, $precision = 2)
    {
        if ($size > 0) {
            $size = (int)$size;
            $base = log($size) / log(1024);
            $suffixes = [' bytes', ' KB', ' MB', ' GB', ' TB'];

            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        } else {
            return $size;
        }
    }
}

