<?php

namespace App\Mail\Admin;

use App\Models\MediaKit;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class CreateMediaKit extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

	public MediaKit $mediaKit;

    /**
     * Create a new message instance.
     */
    public function __construct(MediaKit $mediaKit)
    {
        $this->mediaKit = $mediaKit;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Create Media Kit',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.admin.create-media-kit',
			with: [
				'mediaKit' => $this->mediaKit,
				'senderEmail' => $this->mediaKit->architect->user->email,
				'mailUrl' => env('APP_URL') . '/backend/' .  Str::slug(Str::plural(showModelName($this->mediaKit->story_type))) . '/' . $this->mediaKit->story->id,
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
