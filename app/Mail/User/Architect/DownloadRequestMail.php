<?php

namespace App\Mail\User\Architect;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DownloadRequestMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
		public string $senderEmail,
		public string $name,
		public string $mediaKitTitle,
		public $requestDate,
		public array $data,
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
            subject: $this->data['subscribed'] ? 'New Request to download Your Media Kit' : 'New Publication Requests Waiting for Your Approval',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.user.architect.download-request-email',
			with: [
				'senderEmail' => $this->senderEmail,
				'name' => $this->name,
				'mediaKitTitle' => $this->mediaKitTitle,
				'requestDate' => $this->requestDate,
				'notificationUrl' => route('architect.account.profile.notification'),
				'loginUrl' => route('architect.login'),
				'upgradeUrl' => route('pricing'),
				'data' => $this->data,
				'preferenceUrl' => route('architect.unsubscribe'),
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
