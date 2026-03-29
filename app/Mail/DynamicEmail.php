<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DynamicEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $template;
    public $customMessage;
    public $user;

    public function __construct($template, $customMessage, $user)
    {
        $this->template = $template;
        $this->customMessage = $customMessage;
        $this->user = $user;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->template->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.dynamic',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
