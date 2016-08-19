<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/8/19
 * Time: 17:41
 */
namespace App\Http\Repository;

use App\Tag;

/**
 * Class TagRepository
 * @package App\Http\Repository
 */
class TagRepository
{
    public function getAll()
    {
        return Tag::all();
    }
}