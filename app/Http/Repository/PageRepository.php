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
class PageRepository extends Repository
{
    static $tag = 'page';

    /**
     * @param $name string
     * @return mixed
     */
    public function get($name)
    {
        $page = $this->remember('page.one.' . $name, function () use ($name) {
            return Page::where('name', $name)->first();
        });

        if (!$page)
            abort(404);
        return $page;
    }

    /**
     * @param Request $request
     * @return Page
     */
    public function create(Request $request)
    {
        $this->clearCache();
        return Page::create($request->all());
    }

    public function update(Request $request, Page $page)
    {
        $this->clearCache();
        return $page->update($request->all());
    }

    public function tag()
    {
        return PageRepository::$tag;
    }
}