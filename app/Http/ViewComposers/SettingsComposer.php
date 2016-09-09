<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/8/19
 * Time: 14:41
 */
namespace App\Http\ViewComposers;

use App\Category;
use App\Http\Repository\CategoryRepository;
use App\Http\Repository\MapRepository;
use Illuminate\View\View;

class SettingsComposer
{

    protected $mapRepository;

    /**
     * Create a new profile composer.
     *
     * @internal param UserRepository $users
     * @param MapRepository $mapRepository
     */
    public function __construct(MapRepository $mapRepository)
    {
        $this->mapRepository = $mapRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with($this->mapRepository->getArrayByTag('settings'));
    }
}