<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
});


Artisan::command('avatar', function () {
    $this->comment(\App\User::whereNull('avatar')->update(['avatar' => config('app.avatar')]));
});

Artisan::command('parse', function () {
    $p = new Parsedown();
    foreach (\App\Post::all() as $post) {
        $post->html_content = $p->parse($post->content);
        $this->comment($post->save());
    }
});