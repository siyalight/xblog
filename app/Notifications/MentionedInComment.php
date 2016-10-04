<?php

namespace App\Notifications;

use App\Comment;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MentionedInComment extends Notification implements ShouldQueue
{
    use Queueable;

    protected $comment;
    protected $username;

    public function __construct(Comment $comment, $username)
    {
        $this->comment = $comment;
        $this->username = $username;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $data = $this->comment->getCommentableData();
        return (new MailMessage)
            ->success()
            ->greeting('亲爱的' . $notifiable->name)
            ->to($notifiable->email)
            ->subject('有一条评论提到了您')
            ->line($this->username . '在' . $data['type'] . ':' . $data['title'] . ' 的评论中提到了您')
            ->line($this->comment->content)
            ->action('查看', $data['url']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return $this->comment->toArray();
    }
}
