<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/8/19
 * Time: 17:41
 */
namespace App\Http\Repository;

use App\Category;
use Illuminate\Http\Request;

/**
 * Class CategoryRepository
 * @package App\Http\Repository
 */
class CategoryRepository
{
    static $tag = 'category';

    public $time = 1440;

    /**
     * @return mixed
     */
    public function getAll()
    {
        $categories = cache()->tags(CategoryRepository::$tag)->remember('category.all', $this->time, function () {
            return Category::all();
        });
        return $categories;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function get($name)
    {
        $category = cache()->tags(CategoryRepository::$tag)->remember('category.one.' . $name, $this->time, function () use ($name) {
            return Category::where('name', $name)->first();
        });
        return $category;
    }

    public function pagedPostsByCategory(Category $category, $page = 7)
    {
        $posts = cache()->tags(CategoryRepository::$tag)->remember('category.posts.' . $category->name . $page . request()->get('page', 1), $this->time, function () use ($category, $page) {
            return $category->posts()->with(['tags', 'category'])->orderBy('published_at', 'desc')->paginate($page);
        });
        return $posts;
    }

    /**
     * @param Request $request
     * @return static
     */
    public function create(Request $request)
    {
        $this->clearCache();
        $category = Category::create(['name' => $request['name']]);
        return $category;
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return bool|int
     */
    public function update(Request $request, Category $category)
    {
        $this->clearCache();
        return $category->update($request->all());
    }

    public function clearCache()
    {
        cache()->tags(CategoryRepository::$tag)->flush();
    }
}