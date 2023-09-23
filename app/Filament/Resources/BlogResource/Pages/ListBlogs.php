<?php

namespace App\Filament\Resources\BlogResource\Pages;

use App\Filament\Resources\BlogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBlogs extends ListRecords
{
    protected static string $resource = BlogResource::class;
	protected static ?string $title = 'Blogs List';
	protected ?string $heading = 'Blogs List';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
				->label(__('admin/blogs.create.button_text')),
        ];
    }
}
