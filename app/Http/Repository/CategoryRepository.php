<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/8/19
 * Time: 17:41
 */
namespace App\Http\Repository;

use App\Category;

/**
 * Class CategoryRepository
 * @package App\Http\Repository
 */
class CategoryRepository
{
    public function getAll()
    {
        return Category::all();
    }
}