<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function bindGithub($currentUser, $githubData)
    {
        $currentUser->github_id = $githubData['github_id'];
        $currentUser->github_name = $githubData['name'];
        if (config('app.avatar') == $currentUser->avatar)
            $currentUser->avatar = $githubData['avatar'];

        $meta = $currentUser->meta;
        $meta['github'] = $githubData->user['html_url'];
        $currentUser->meta = $meta;

        return $currentUser->save();
    }

    public function store(Request $request)
    {
        if (!session()->has('githubData')) {
            return redirect('login');
        }

        $name = $request->get('name');
        $email = $request->get('email');
        $this->validate($request, [
            'name' => 'required|max:16|min:3|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.unique' => "Username  '$name'  has been registered,if it is you,then you can login to bind your github account",
            'email.unique' => "Email  '$email'  has been registered,if it is you,then you can login to bind your github account",
        ]);
        dd(array_merge(session('githubData'), request()->all()));

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->avatar = config('app.avatar');
        $user->register_from = 'github';
        $user->password = bcrypt($request->get('password'));
        if ($user = $this->bindGithub($user, session('githubData'))) {
            auth()->loginUsingId($user->id);
            session()->forget('githubData');
            return redirect()->route('post.index')->with('success', '使用Github注册成功');
        } else {
            session()->forget('githubData');
            return redirect()->route('post.index')->with('success', '使用Github注册失败');
        }
    }

    public function registerFromGithub()
    {
        if (!session()->has('githubData')) {
            return redirect('login');
        }
        $githubData = array_merge(session('githubData'), request()->old());
        return view('auth.github_register', compact('githubData'));
    }


    public function handleGithubCallback()
    {
        $githubUser = Socialite::driver('github')->user();
        $user = User::where('github_id', $githubUser->id)->first();
        /*var_dump($githubUser);
        echo '<br><br><br>';
        var_dump($user);
        echo '<br><br><br>';*/

        if (auth()->check()) {
            $currentUser = auth()->user();
            if ($currentUser->github_id && $currentUser->github_id == $githubUser->id) {
                return redirect()->route('post.index');
            } else if ($currentUser->github_id == null) {
                if ($this->bindGithub($currentUser, $this->getDataFromGithubUser($githubUser)))
                    return redirect()->route('post.index')->with('success', '绑定 Github 成功');
                return redirect()->route('post.index')->withErrors('绑定 Github 失败');
            } else {
                return redirect()->route('post.index')->withErrors('Sorry,you have bind a different github account!');
            }
        } else if ($user) {
            auth()->loginUsingId($user->id);
            return redirect()->route('post.index')->with('success', '登录成功');
        } else {
            $githubData = $this->getDataFromGithubUser($githubUser);

            session()->put('githubData', $githubData);
            return redirect()->route('github.register');
        }
    }

    private function getDataFromGithubUser($githubUser)
    {
        $githubData['github_id'] = $githubUser->id;
        $githubData['email'] = $githubUser->email;
        $githubData['avatar'] = $githubUser->avatar;
        $githubData['name'] = $githubUser->nickname;
        $githubData['url'] = $githubUser->user['html_url'];
        return $githubData;
    }
}
