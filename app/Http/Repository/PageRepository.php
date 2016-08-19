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
    public $tag = 'page';

    public $time = 1440;

    /**
     * @param $name string
     * @return mixed
     */
    public function get($name)
    {
        $page = cache()->tags($this->tag)->remember('page.one.' . $name, $this->time, function () use ($name) {
            return Page::where('name', $name)->first();
        });

        if (!$page)
            abort(404);
        return $page;
    }

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

    public function clearCache()
    {
        cache()->tags($this->tag)->flush();
    }
}