<?php

namespace App\Http\Controllers;

use App\Http\Repositories\PageRepository;
use App\Page;
use Illuminate\Http\Request;

use App\Http\Requests;

class PageController extends Controller
{

    protected $pageRepository;

    /**
     * PageController constructor.
     * @param $pageRepository
     */
    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }


    private function pageShowing($page)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $unreadNotifications = $user->unreadNotifications;
            foreach ($unreadNotifications as $notifications) {
                $comment = $notifications->data;
                if ($comment['commentable_type'] == 'App\Page' && $comment['commentable_id'] == $page->id) {
                    $notifications->markAsRead();
                }
            }
        }
    }

    public function show($name)
    {
        $page = $this->pageRepository->get($name);
        if ($page->configuration && $page->configuration->config['display'] == 'false') {
            if (isAdmin(auth()->user())) {
                return view('page.show', compact('page'));
            } else {
                abort(404);
            }
        }
        $this->pageShowing($page);
        return view('page.show', compact('page'));
    }
}
