<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class WechatController extends Controller
{	

	public function getToken(){
		$ch = curl_init();
	　　//设置选项，包括URL
	　　curl_setopt($ch, CURLOPT_URL, "http://www.jb51.net");
	　　curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	　　curl_setopt($ch, CURLOPT_HEADER, 0);
	　　//执行并获取HTML文档内容
	　　$output = curl_exec($ch);
	　　//释放curl句柄
	　　curl_close($ch);
	　　//打印获得的数据
	　　print_r($output);
	}
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function($message){
            return "欢迎关注 overtrue！";
        });

        Log::info('return response.');

        return $wechat->server->serve();
    }
}
