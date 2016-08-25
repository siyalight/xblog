<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/8/24
 * Time: 11:10
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Repository\CategoryRepository;

class CategoryApiController extends Controller
{
    protected $categoryRepository;

    /**
     * CategoryApiController constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        /*$this->middleware('auth:api');*/
    }

    public function index()
    {
        return $this->categoryRepository->getAll();
    }
}