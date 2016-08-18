<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::truncate();
        \App\Post::truncate();
        \App\Category::truncate();
        \App\Tag::truncate();
        Model::unguard();
        // $this->call(UsersTableSeeder::class);
        factory(App\User::class, 50)->create();
        $tag_ids = \App\Tag::all();
        dd(count($tag_ids));
        factory(App\User::class, 50)->create()->each(function($u) use($tag_ids) {
            $posts = factory(App\Post::class,mt_rand(0,20))->make();
            foreach ($posts as $post)
            {
                $count = mt_rand(0,4);
                $ids=[];
                for ($i = 0;$i<$count;$i++)
                {
                    array_push($ids,$tag_ids[mt_rand(1,50)]);
                }
                $post->tags()->sync($ids);
                $u->posts()->save($post);
            }
        });
    }
}
