<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/9/17
 * Time: 17:10
 */

namespace Lufficc;

use Qiniu\Auth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;

class FileUploadManager
{
    private $bucket;
    private $token;
    private $uploadManager;
    private $bucketManager;

    /**
     * ImageRepository constructor.
     */
    public function __construct()
    {
        $accessKey = env('QINIU_AK');
        $secretKey = env('QINIU_SK');
        $this->bucket = env('QINIU_BUCKET');
        $auth = new Auth($accessKey, $secretKey);
        $this->token = $auth->uploadToken($this->bucket);
        $this->uploadManager = new UploadManager();
        $this->bucketManager = new BucketManager($auth);
    }

    public function uploadFile($key, $filePath)
    {
        list($ret, $err) = $this->uploadManager->putFile($this->token, $key, $filePath);
        if ($err !== null) {
            return false;
        } else {
            return true;
        }
    }

    public function deleteFile($key)
    {
        $err = $this->bucketManager->delete($this->bucket, $key);
        if ($err !== null) {
            return false;
        } else {
            return true;
        }
    }
}