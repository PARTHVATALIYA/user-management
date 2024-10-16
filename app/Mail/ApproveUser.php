<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApproveUser extends Mailable
{
    protected $userName, $email, $redirectUrl;
    /**
     * Create a new message instance.
     */
    public function __construct($adminMailData)
    {
        if (isset($adminMailData['userName'])) {
            $this->userName = $adminMailData['userName'];
        }

        if (isset($adminMailData['email'])) {
            $this->email = $adminMailData['email'];
        }

        if (isset($adminMailData['url'])) {
            $this->redirectUrl = $adminMailData['url'];
        }
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Approve User',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'auth.approveUser',
            with: array(
                'userName' => $this->userName,
                'email' => $this->email,
                'redirectUrl' => $this->redirectUrl,
            ),
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
