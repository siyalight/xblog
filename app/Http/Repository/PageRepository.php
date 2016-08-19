<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/8/19
 * Time: 17:41
 */
namespace App\Http\Repository;

use App\Page;
use Illuminate\Http\Request;

/**
 * Class PageRepository
 * @package App\Http\Repository
 */
class PageRepository
{
    /**
     * @param $name string
     * @return mixed
     */
    public function get($name)
    {
        $page = Page::where('name', $name)->first();
        if (!$page)
            abort(404);
        return $page;
    }

    public function create(Request $request)
    {
        return Page::create($request->all());
    }

    public function update(Request $request, $name)
    {
        return $this->get($name)->update($request->all());
    }
}