<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2017/2/28
 * Time: 17:41
 */
namespace App\Http\Repositories;

use App\Ip;


class IpRepository extends Repository
{
    static $tag = 'ip';

    public function createIfNotExisted($ip_address)
    {
        return Ip::firstOrCreate(['id' => $ip_address]);
    }

    public function toggleBlock($ip_address)
    {
        $ip = Ip::findOrFail($ip_address);
        $ip->blocked = !$ip->blocked;
        return $ip->save();
    }


    public function isBlocked($ip_address)
    {
        $ip = Ip::findOrFail($ip_address);
        return $ip != null && $ip->blocked;
    }

    public function getOne($ip_address)
    {
        return Ip::findOrFail($ip_address);
    }

    public function model()
    {
        return app(IpRepository::class);
    }

    public function tag()
    {
        return IpRepository::$tag;
    }
}