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

	public static function canAccess(): bool
	{
		return auth()->user()->hasRole('Super Admin');
	}

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
				Tables\Columns\TextColumn::make('url')
					->state(fn (TopJournalistList $record): string => route('top-journalists', [
							'categorySlug' => $record->topJournalist->category_slug,
							'countrySlug' => $record->topJournalist->location_slug,
						])
					)
					->icon('heroicon-m-globe-alt')
					->iconColor('primary')
					->copyable()
					->copyMessage('Url copied')
					->copyMessageDuration(1500),
				Tables\Columns\ImageColumn::make('journalist.profileImage.image_path')
					->label('Profile Image'),
				Tables\Columns\TextColumn::make('journalist.user.name')
                    ->searchable()
					->sortable(),
                Tables\Columns\TextInputColumn::make('rank_order')
					->rules(['numeric'])
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
			// ->defaultGroup('url')
			->defaultGroup('topJournalist.list_type')
			// ->groups([
			// 	Tables\Grouping\Group::make('topJournalist.list_type')
            //     	->label('Top Journalist List'),
			// ])
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
