<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/9/20
 * Time: 18:02
 */

namespace Lufficc;
use Exception;
use Illuminate\Session\TokenMismatchException;

class BlogExceptionHandler
{
    /**
     * @param $request
     * @param Exception $exception
     * @return bool
     */
    public function handler($request, Exception $exception)
    {
        if ($exception instanceof TokenMismatchException) {
            abort(403);
        }
        return false;
    }
}