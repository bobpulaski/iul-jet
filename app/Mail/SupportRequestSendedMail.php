<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SupportRequestSendedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public $userName, public $userEmail, public $userIp, public $requestType, public $requestSubject, public $requestBody)
    {
        $this->userName = $userName;
        $this->userEmail = $userEmail;
        $this->userIp = $userIp;
        $this->requestType = $requestType;
        $this->requestSubject = $requestSubject;
        $this->requestBody = $requestBody;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // subject: 'Обращение (' . $this->userName . ')',
            subject: "Обращение ({$this->userName})",
            replyTo: $this->userEmail,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.mail-support-request',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
