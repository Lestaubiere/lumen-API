<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class Contact extends Mailable
{
    public $content;
    protected $fromEmail;
    protected $fromName;

    public function __construct($fromName, $fromEmail, $content)
    {
        $this->fromName = $fromName;
        $this->fromEmail = $fromEmail;
        $this->content = $content;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->fromEmail, $this->fromName)
                    ->view('ContactEmail');
    }
}
