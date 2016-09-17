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

if (!function_exists('getUrlByFileName')) {
    function getUrlByFileName($fileName)
    {
        return 'https://static.lufficc.com/' . $fileName;
    }
}
