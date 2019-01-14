<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;
	protected $title;
	protected $description;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title,$description)
    {
         $this->title = $title;
		 $this->description = $description;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Task Notification!')->view('emails.mail')->with([
                        'title' => $this->title,
                        'description' => $this->description,
                    ]);;
    }
}
