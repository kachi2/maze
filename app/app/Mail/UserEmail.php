<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use App\User;
use Illuminate\Queue\SerializesModels;

class UserEmail extends Mailable
{
    use Queueable, SerializesModels;
   /**
     * @var User
     */
    private $user;

    /**
     * @var Subject
     */
    public $subject;

    /**
     * @var Text
     */
    private $text;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
      
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return  $this->subject('email from me')->from('support@mazeoptions.com', 'mazeoptions')->view('emails.message-user', ['user' => $this->user]);
    }

   
}
