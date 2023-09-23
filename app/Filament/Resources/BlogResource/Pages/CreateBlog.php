<?php

namespace App\Filament\Resources\BlogResource\Pages;

use App\Filament\Resources\BlogResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateBlog extends CreateRecord
{
	protected static string $resource = BlogResource::class;

	public function getHeading(): string
	{
		return __('admin/blogs.create.heading');
	}

	public function getTitle(): string|Htmlable
	{
		return __('admin/blogs.create.title');
	}

	protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title(__('admin/blogs.create.success_notification.title'))
            ->body(__('admin/blogs.create.success_notification.body'));
    }
}
