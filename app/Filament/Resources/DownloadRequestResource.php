<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DownloadRequestResource\Pages;
use App\Filament\Resources\DownloadRequestResource\RelationManagers;
use App\Models\DownloadRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DownloadRequestResource extends Resource
{
    protected static ?string $model = DownloadRequest::class;

	protected static ?string $label = 'Download Requests';
	protected static ?string $navigationLabel = 'Download Requests';

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\Select::make('media_kit_id')
                //     ->relationship('mediaKit', 'id')
                //     ->required(),
                // Forms\Components\TextInput::make('requested_by')
                //     ->required()
                //     ->maxLength(36),
                // Forms\Components\TextInput::make('request_status')
                //     ->required()
                //     ->maxLength(255)
                //     ->default('pending'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('id')
                //     ->label('ID')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('mediaKit.story.title')
					->label('Mediakit Title')
					->searchable()
					->sortable()
					->wrap(),
				Tables\Columns\TextColumn::make('mediaKit.architect.user.name')
					->label('Architect')
					->searchable()
					->sortable(),
                Tables\Columns\TextColumn::make('requestedJournalist.name')
					->label('Journalist')
					->searchable()
					->sortable(),
                Tables\Columns\TextColumn::make('request_status')
					->label('Status')
                    ->searchable()
					->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
			->groups([
				Group::make('mediaKit.architect.user.name')
                	->label('Architect')
					->collapsible(),
				Group::make('media_kit_id')
                	->label('Media Kit')
					->getTitleFromRecordUsing(fn (DownloadRequest $record): string => $record->mediaKit->story->title)
					->collapsible(),
				Group::make('requestedJournalist.name')
                	->label('Journalist')
					->collapsible(),
				Group::make('request_status')
                	->label('Status')
					->getTitleFromRecordUsing(fn (DownloadRequest $record): string => $record->request_status->value)
					->collapsible(),
			])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageDownloadRequests::route('/'),
        ];
    }
}
