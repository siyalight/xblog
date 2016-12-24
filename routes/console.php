<?php

use Illuminate\Foundation\Inspiring;
use Lufficc\MarkDownParser;

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
})->describe('inspire');;


Artisan::command('post {action}', function ($action) {
    $markdownParser = new MarkDownParser();
    switch ($action) {
        case 'des2html':
            foreach (\App\Post::all() as $post) {
                $post->description = $markdownParser->parse($post->description, false);
                $this->comment($post->save());
            }
            break;
        case 'content2html':
            foreach (\App\Post::all() as $post) {
                $post->html_content = $markdownParser->parse($post->content, false);
                $this->comment($post->save());
            }
            break;
    }

})->describe('post { des2html | content2html }');;


Artisan::command('avatar', function () {
    $this->comment(\App\User::whereNull('avatar')->update(['avatar' => config('app.avatar')]));
})->describe("set users's null avatar to default avatar");


Artisan::command('xssProtection', function () {
    $mp = new MarkDownParser();
    foreach (\App\Comment::withoutGlobalScopes()->get() as $comment) {
        $this->comment("----------------------------------------------------------------------------------------\n");
        $this->comment($comment->content . "\n\n");
        $this->comment($comment->html_content . "\n\n");
        $parsed = $mp->parse($comment->content);
        $this->comment($parsed . "\n\n");
        $comment->html_content = $parsed;
        $this->comment('save:' . $comment->save());
        $this->comment("----------------------------------------------------------------------------------------");
    }

})->describe("protect user comments from xss");;
