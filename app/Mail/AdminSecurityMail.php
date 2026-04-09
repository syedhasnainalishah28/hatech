<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminSecurityMail extends Mailable
{
    use Queueable, SerializesModels;

    public $type;
    public $data;

    /**
     * Create a new message instance.
     *
     * @param string $type ('otp' or 'alert')
     * @param array $data
     */
    public function __construct($type, $data)
    {
        $this->type = $type;
        $this->data = $data;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        if ($this->type === 'otp') {
            return $this->subject('Verify Your Admin Identity - HA Tech')
                        ->view('emails.admin_otp');
        }

        return $this->subject('Security Alert - HA Tech Secure Portal')
                    ->view('emails.security_alert');
    }
}
