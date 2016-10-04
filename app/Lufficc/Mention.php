<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/9/19
 * Time: 1:32
 */

namespace Lufficc;


use App\Comment;
use App\Notifications\MentionedInComment;
use App\User;
use Laravel\Socialite\Two\InvalidStateException;

class Mention
{
    public $body_parsed;
    public $users = [];
    public $usernames;
    public $body_original;

    public $comment;

    /**
     * @return array
     */
    public function getMentionedUsername()
    {
        preg_match_all("/(\S*)\@([^\r\n\s]*)/i", $this->body_original, $atlist_tmp);
        $usernames = [];
        foreach ($atlist_tmp[2] as $k => $v) {
            if ($atlist_tmp[1][$k] || strlen($v) > 25) {
                continue;
            }
            $usernames[] = $v;
        }
        return array_unique($usernames);
    }

    public function replace()
    {
        $this->body_parsed = $this->body_original;

        foreach ($this->users as $user) {
            $search = '@' . $user->name;
            $place = '[' . $search . '](' . route('user.show', $user->name) . ')';
            $this->body_parsed = str_replace($search, $place, $this->body_parsed);
            /*$this->notify($user);*/
        }
    }

    public function notify($user)
    {
        if ($this->comment) {
            $user->notify(new MentionedInComment($this->comment, $this->comment->username));
        }
    }

    public function parse(Comment $comment, $content)
    {
        $this->comment = $comment;
        $this->body_original = $content;

        $this->usernames = $this->getMentionedUsername();
        count($this->usernames) > 0 && $this->users = User::whereIn('name', $this->usernames)->get();

        $this->replace();
        return $this->body_parsed;
    }
}