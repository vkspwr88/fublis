<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImageLogResource\Pages;
use App\Filament\Resources\ImageLogResource\RelationManagers;
use App\Models\ImageLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class ImageLogResource extends Resource
{
    protected static ?string $model = ImageLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

	public static function canAccess(): bool
	{
		return auth()->user()->hasRole('Super Admin');
	}

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\TextInput::make('file_type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('file_path')
                    ->required()
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
				Tables\Columns\ColumnGroup::make('User', [
					Tables\Columns\TextColumn::make('user.name')
						->label('Name')
						->searchable(),
					Tables\Columns\TextColumn::make('user.email')
						->label('Email')
						->icon('heroicon-m-envelope')
						->iconColor('primary')
						->searchable(),
				]),
                Tables\Columns\TextColumn::make('file_type')
                    ->searchable(),
				Tables\Columns\TextColumn::make('file_path')
					->url(fn (ImageLog $record): string => Storage::url($record->file_path))
					->openUrlInNewTab()
                    ->searchable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                /* Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(), */
            ])
            ->bulkActions([
                /* Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]), */
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageImageLogs::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
