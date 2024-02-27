<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TopPublicationListResource\Pages;
use App\Filament\Resources\TopPublicationListResource\RelationManagers;
use App\Models\TopPublicationList;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TopPublicationListResource extends Resource
{
    protected static ?string $model = TopPublicationList::class;
	protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
	protected static ?string $navigationGroup = 'Top Publications';
    protected static ?string $label = 'List';
	protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('top_publication_id')
                    ->relationship('topPublication', 'list_type')
                    ->required(),
                Forms\Components\Select::make('publication_id')
                    ->relationship('publication', 'name')
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
                /* Tables\Columns\TextColumn::make('topPublication.list_type')
					->label('List type')
                    ->searchable(), */
                Tables\Columns\TextColumn::make('publication.name')
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
			/* ->groups([
				'topPublication.list_type',
			]) */
			->defaultGroup('topPublication.list_type')
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
            'index' => Pages\ListTopPublicationLists::route('/'),
            'create' => Pages\CreateTopPublicationList::route('/create'),
            'edit' => Pages\EditTopPublicationList::route('/{record}/edit'),
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
