<?php

namespace App\Notifications;

use App\Models\Deposit;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InvestmentCreated extends Notification
{
    use Queueable;

    /**
     * @var Deposit
     */
    protected $trade;

    /**
     * Create a new notification instance.
     *
     * @param Deposit $trade
     */
    public function __construct(Deposit $trade)
    {
        $this->trade = $trade;
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
                    ->subject('Deposit Completed Successfully #'.$this->trade->ref)
                    ->from('billing@mazeoptions.com', 'mazeoptions')
                    ->view('emails.deposit-created', ['deposit' => $this->trade]);
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
