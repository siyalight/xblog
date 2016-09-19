<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleGithubCallback()
    {
        $user = Socialite::driver('github')->user();
        dd($user);
        // $user->token;
    }
}
