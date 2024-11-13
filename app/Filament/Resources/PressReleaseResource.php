<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PressReleaseResource\Pages;
use App\Filament\Resources\PressReleaseResource\RelationManagers;
use App\Models\PressRelease;
use App\Models\User;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PressReleaseResource extends Resource
{
    protected static ?string $model = PressRelease::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

	protected static ?string $recordTitleAttribute = 'title';

	public static function canAccess(): bool
	{
		$user = User::find(auth()->id());
		return $user->hasRole('Super Admin');
	}

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // CuratorPicker::make('cover_image_path')
				Forms\Components\FileUpload::make('cover_image_path')
					->downloadable()
					->label('Cover Image (800 x 400)')
					// ->buttonLabel('Select Cover Image')
                    ->acceptedFileTypes(['image/*'])
					->columnSpanFull()
					->directory('images/press-releases/cover-images')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('image_credits')
					->maxLength(65535),
                Forms\Components\Textarea::make('concept_note')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
				TiptapEditor::make('press_release_writeup')
					->tools(['heading', 'hr', 'bold', 'italic', 'bullet-list', 'ordered-list', 'lead', 'small', 'blockquote',])
					->extraInputAttributes(['style' => 'min-height: 12rem;'])
                    ->required()
                    ->columnSpanFull(),
                /* Forms\Components\Textarea::make('press_release_writeup')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(), */
				Forms\Components\FileUpload::make('press_release_doc_path')
					->directory('documents/press-releases/company-profiles')
					->downloadable()
                    ->columnSpanFull(),
                /* Forms\Components\Textarea::make('press_release_doc_path')
                    ->maxLength(65535)
                    ->columnSpanFull(), */
                Forms\Components\Textarea::make('press_release_doc_link')
                    ->maxLength(65535)
                    ->columnSpanFull(),
				Forms\Components\FileUpload::make('photographs')
					->downloadable()
					->directory('images/press-releases/photographs')
					->multiple()
					->reorderable()
					->appendFiles()
					->openable()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('photographs_link')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                /* Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(), */
                Tables\Columns\ImageColumn::make('cover_image_path'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
				Tables\Columns\TextColumn::make('download_count')
					->state(function (Model $record): int {
						return $record->mediakit[0]->downloadRequests()->count();
					}),
				Tables\Columns\TextColumn::make('pending_download_count')
					->state(function (Model $record): int {
						return $record->mediakit[0]->downloadRequests()->where('request_status', 'pending')->count();
					}),
                Tables\Columns\ImageColumn::make('image_credits'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
			->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPressReleases::route('/'),
            'create' => Pages\CreatePressRelease::route('/create'),
            'view' => Pages\ViewPressRelease::route('/{record}'),
            'edit' => Pages\EditPressRelease::route('/{record}/edit'),
        ];
    }
}
