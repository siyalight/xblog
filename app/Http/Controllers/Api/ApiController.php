<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/12/9
 * Time: 16:16
 */

namespace App\Http\Controllers\Api;


class ApiController
{
    public function result($result, $code = 200)
    {
        return [
            'code' => $code,
            'data' => $result,
        ];
    }

    public function paginate($pagination)
    {
        return $pagination;
    }
}