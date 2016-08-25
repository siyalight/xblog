<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/8/24
 * Time: 11:56
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Repository\CategoryRepository;
use App\Http\Repository\PostRepository;
use App\Http\Repository\TagRepository;

class PostApiController extends Controller
{
    protected $postRepository;
    protected $tagRepository;
    protected $categoryRepository;


    /**
     * PostController constructor.
     * @param PostRepository $postRepository
     * @param CategoryRepository $categoryRepository
     * @param TagRepository $tagRepository
     */
    public function __construct(PostRepository $postRepository, CategoryRepository $categoryRepository, TagRepository $tagRepository)
    {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
        /*$this->middleware('auth:api');*/
    }

    public function index()
    {
        $categoryName = request()->get('category', null);
        if (!empty($categoryName)) {
            $category = $this->categoryRepository->get($categoryName);
            if (!$category)
                abort(404);
            $posts = $this->categoryRepository->pagedPostsByCategory($category);
        } else {
            $posts = $this->postRepository->pagedPosts();
        }
        return $posts;
    }

    public function show($slug)
    {
        return request()->user();
        $post = $this->postRepository->get($slug);
        return $post;
    }
}