<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PitchResource\Pages;
use App\Filament\Resources\PitchResource\RelationManagers;
use App\Models\Pitch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PitchResource extends Resource
{
    protected static ?string $model = Pitch::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
	protected static ?string $label = 'Pitches';
	protected static ?string $navigationLabel = 'Lists';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('journalist_id')
                    ->relationship('journalist', 'slug')
                    ->required(),
                Forms\Components\Select::make('media_kit_id')
                    ->relationship('mediaKit', 'slug')
                    ->required(),
                Forms\Components\TextInput::make('subject')
                    ->required()
                    ->maxLength(255),
				TiptapEditor::make('message')
					->tools(['heading', 'hr', 'bold', 'italic', 'bullet-list', 'ordered-list', 'lead', 'small', 'blockquote',])
					->extraInputAttributes(['style' => 'min-height: 12rem;'])
                    ->required()
                    ->columnSpanFull(),
               /*  Forms\Components\Textarea::make('message')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(), */
				Forms\Components\Select::make('publication_id')
                    ->relationship('publication', 'name')
                    ->required(),
                /* Forms\Components\TextInput::make('publication_id')
                    ->required()
                    ->maxLength(36), */
                /* Forms\Components\TextInput::make('pitchable_type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('pitchable_id')
                    ->required()
                    ->maxLength(36), */
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                /* Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(), */
                Tables\Columns\TextColumn::make('journalist.slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mediaKit.slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject')
                    ->searchable(),
                Tables\Columns\TextColumn::make('publication.name')
                    ->searchable(),
                /* Tables\Columns\TextColumn::make('pitchable_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pitchable_id')
                    ->searchable(), */
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
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePitches::route('/'),
        ];
    }
}
