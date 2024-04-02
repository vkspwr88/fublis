<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TopPublicationResource\Pages;
use App\Filament\Resources\TopPublicationResource\RelationManagers;
use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\PublicationController;
use App\Models\TopPublication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TopPublicationResource extends Resource
{
    protected static ?string $model = TopPublication::class;
    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
	protected static ?string $navigationGroup = 'Top Publications';
    protected static ?string $label = 'Type';
	protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
				Forms\Components\Grid::make([
					'default' => 1,
    				'sm' => 2,
				])
				->schema([
					Forms\Components\Fieldset::make('')
						->schema([
							Forms\Components\TextInput::make('list_type')
								->required()
								->label('Heading')
								->columnSpanFull()
								->maxLength(255),
							Forms\Components\Select::make('category_id')
								->relationship('category', 'name')
								->live(onBlur: true)
								->afterStateUpdated(function(string $operation, $state, Set $set){
									if($operation !== 'create' && $operation !== 'edit'){
										return;
									}
									$set('category_slug', Str::slug(CategoryController::findById($state)->name));
								})
								->searchable()
								->preload()
								->required(),
							Forms\Components\TextInput::make('category_slug')
								->required()
								->maxLength(255),
							Forms\Components\Select::make('location_id')
								->label('Country')
								->live(onBlur: true)
								->options(LocationController::getCountries()->pluck('name', 'name'))
								->afterStateUpdated(function(string $operation, $state, Set $set){
									if($operation !== 'create' && $operation !== 'edit'){
										return;
									}
									$set('location_slug', Str::slug($state));
								})
								->searchable()
								->preload()
								->required(),
							Forms\Components\TextInput::make('location_slug')
								->required()
								->label('Country slug')
								->maxLength(255),
						])->columnSpan(2),

					Forms\Components\Fieldset::make('')
						->schema([
							Forms\Components\Repeater::make('topPublicationList')
								->relationship()
								->schema([
									Forms\Components\Select::make('publication_id')
										->label('Select publication')
										->required()
										// ->multiple()
										->options(PublicationController::getAll()->pluck('name', 'id'))
										->searchable()
										->preload()
										->loadingMessage('Loading publications...')
										->noSearchResultsMessage('No publications found.')
										->searchingMessage('Searching publications...')
										/* ->createOptionForm([
											Forms\Components\TextInput::make('name')
												->required()
												->unique(),
										]) */,
									Forms\Components\TextInput::make('rank_order')
										->numeric()
										->default(100)
										->required(),
								])
								->defaultItems(1)
								->addActionLabel('Add publication')
								->columns(2)
								->columnSpan(2)
						])
						// ->columnSpan(2),
				])
			]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                /* Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(), */
                Tables\Columns\TextColumn::make('list_type')
                    ->searchable(),
				Tables\Columns\TextColumn::make('url')
					->state(fn (TopPublication $record): string => route('top-publications', [
							'categorySlug' => $record->category_slug,
							'countrySlug' => $record->location_slug,
						])
					)
					->icon('heroicon-m-globe-alt')
					->iconColor('primary')
					->copyable()
					->copyMessage('Url copied')
					->copyMessageDuration(1500),
                Tables\Columns\TextColumn::make('category.name')
                    ->searchable(),
                /* Tables\Columns\TextColumn::make('category_slug')
                    ->searchable(), */
                Tables\Columns\TextColumn::make('location.name')
                    ->searchable(),
                /* Tables\Columns\TextColumn::make('location_slug')
                    ->searchable(), */
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
            'index' => Pages\ListTopPublications::route('/'),
            'create' => Pages\CreateTopPublication::route('/create'),
            'edit' => Pages\EditTopPublication::route('/{record}/edit'),
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
