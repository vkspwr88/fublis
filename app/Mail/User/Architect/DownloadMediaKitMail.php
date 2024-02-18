<?php

namespace App\Mail\User\Architect;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DownloadMediaKitMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
		public string $email,
		public string $name,
		public string $mediaKitTitle,
		public string $downloadDate,
	)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Journalist Has Downloaded Your Media Kit on Fublis',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.user.architect.download-media-kit-email',
			with: [
				'senderEmail' => $this->email,
				'name' => $this->name,
				'mediaKitTitle' => $this->mediaKitTitle,
				'downloadDate' => $this->downloadDate,
				'loginUrl' => route('architect.login'),
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
