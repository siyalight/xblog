<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/8/19
 * Time: 17:41
 */
namespace App\Http\Repositories;

use App\User;
use Illuminate\Http\Request;

/**
 * Class PageRepository
 * @package App\Http\Repository
 */
class UserRepository extends Repository
{
    static $tag = 'user';

    public function model()
    {
        return app(User::class);
    }

    /**
     * @param $name string
     * @return mixed
     */
    public function get($name)
    {
        $user = $this->remember('user.one.' . $name, function () use ($name) {
            return User::where('name', $name)->firstOrFail();
        });
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $user->description = $request->get('description');
        $user->website = $request->get('website');
        $user->real_name = $request->get('real_name');

        $exception = ['_method', '_token', 'description', 'website', 'real_name', 'name',];
        /*if ($user->github_id) {
            $exception = ['_method', '_token', 'github', 'description', 'website', 'real_name', 'name',];
        }*/
        $meta = $request->except($exception);
        $user->meta = $meta;
        $result = $user->save();
        if ($result)
            $this->clearCache();
        return $result;
    }

    public function tag()
    {
        return UserRepository::$tag;
    }
}