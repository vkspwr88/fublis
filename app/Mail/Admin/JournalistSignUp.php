<?php

namespace App\Mail\Admin;

use App\Models\Journalist;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JournalistSignUp extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

	public Journalist $journalist;

    /**
     * Create a new message instance.
     */
    public function __construct(Journalist $journalist)
    {
        $this->journalist = $journalist;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Journalist Sign Up',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.admin.journalist-signup',
			with: [
				'journalist' => $this->journalist,
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
