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

Artisan::command('xssProtection', function () {
    $mp = new \Lufficc\MarkDownParser();
    foreach (\App\Comment::all() as $comment) {
        $this->comment("----------------------------------------------------------------------------------------\n");

        $this->comment($comment->content . "\n\n");
        $this->comment($comment->html_content . "\n\n");
        $this->comment($mp->parse($comment->content));

        $this->comment("----------------------------------------------------------------------------------------");
    }

});
