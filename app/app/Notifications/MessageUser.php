<?php

namespace App\Notifications;

use App\User;
use Hamcrest\Thingy;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MessageUser extends Notification
{
    use Queueable;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var Subject
     */
    protected $subject;

    /**
     * @var Text
     */
    private $text;


    /**
     * Create a new notification instance.
     *
     * @param User $user
     * @param double$amount
     */
    public function __construct(User $user, $text, $subject)
    {
        $this->user = $user;
        $this->text = $text;
        $this->subject = $subject;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject($this->subject)
                    ->from('support@mazeoptions.com', 'mazeoptions')
                    ->view('emails.message-user', ['user' => $this->user, 'text' => $this->text, 'subject' => $this->subject]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
