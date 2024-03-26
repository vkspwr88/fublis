<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TopJournalistListResource\Pages;
use App\Filament\Resources\TopJournalistListResource\RelationManagers;
use App\Models\TopJournalistList;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TopJournalistListResource extends Resource
{
    protected static ?string $model = TopJournalistList::class;

	// protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
	protected static ?string $navigationGroup = 'Top Journalists';
    protected static ?string $label = 'List';
	protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('top_journalist_id')
                    ->relationship('topJournalist', 'list_type')
                    ->required(),
                Forms\Components\Select::make('journalist_id')
                    ->relationship('journalist', 'name')
					->searchable()
					->preload()
                    ->required(),
                Forms\Components\TextInput::make('rank_order')
                    ->required()
                    ->numeric()
                    ->default(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                /* Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(), */
                /* Tables\Columns\TextColumn::make('topJournalist.list_type')
					->label('List type')
                    ->searchable(), */
                Tables\Columns\TextColumn::make('journalist.user.name')
                    ->searchable()
					->sortable(),
                Tables\Columns\TextColumn::make('rank_order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
			->defaultGroup('topJournalist.list_type')
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListTopJournalistLists::route('/'),
            'create' => Pages\CreateTopJournalistList::route('/create'),
            'edit' => Pages\EditTopJournalistList::route('/{record}/edit'),
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
