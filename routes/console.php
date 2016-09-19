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
    \App\User::where('id', '>', 0)->update(['avatar' => 'https://static.lufficc.com/image/default_avatar.png']);
});
