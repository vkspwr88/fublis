<?php

namespace App\Mail\User\Journalist;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DailyMediaKitMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
		public string $email,
		public string $name,
		public $mediaKits,
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
            subject: 'New Media Kits Available on the Platform',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.user.journalist.daily-media-kit-email',
			with: [
				'senderEmail' => $this->email,
				'name' => $this->name,
				'mediaKits' => $this->mediaKits,
				'mediaKitsUrl' => route('journalist.media-kit.index'),
				'loginUrl' => route('journalist.login'),
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
