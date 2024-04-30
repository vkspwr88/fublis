<?php

namespace App\Mail\Admin;

use App\Models\Architect;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ArchitectSignUp extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

	public Architect $architect;

    /**
     * Create a new message instance.
     */
    public function __construct(Architect $architect)
    {
        $this->architect = $architect;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Architect Sign Up',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.admin.architect-signup',
			with: [
				'architect' => $this->architect,
			],
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
