<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/9/21
 * Time: 23:00
 */

namespace Lufficc;

use Parsedown;

class MarkDownParser
{
    protected $parseDown;

    /**
     * MarkDownParser constructor.
     */
    public function __construct()
    {
        $this->parseDown = new Parsedown();
    }

    public function parse($markdown)
    {
        $convertedHmtl = $this->parseDown->text($markdown);
        /*$convertedHmtl = clean($convertedHmtl, 'user_comment_content');*/
        return $convertedHmtl;
    }
}