<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TopJournalistResource\Pages;
use App\Filament\Resources\TopJournalistResource\RelationManagers;
use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\JournalistController;
use App\Http\Controllers\Users\LocationController;
use App\Models\TopJournalist;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TopJournalistResource extends Resource
{
    protected static ?string $model = TopJournalist::class;
    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
	// protected static ?string $navigationGroup = 'Top Journalists';
    protected static ?string $label = 'Type';
	protected static ?int $navigationSort = 2;

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
							Forms\Components\Repeater::make('topJournalistList')
								->relationship()
								->schema([
									Forms\Components\Select::make('journalist_id')
										->label('Select journalist')
										->required()
										// ->multiple()
										->options(JournalistController::getAll()->pluck('user.name', 'id'))
										->searchable()
										->preload()
										->loadingMessage('Loading journalists...')
										->noSearchResultsMessage('No journalists found.')
										->searchingMessage('Searching journalists...')
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
								->addActionLabel('Add journalist')
								->columns(2)
								->columnSpan(2)
						])
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
					->state(fn (TopJournalist $record): string => route('top-journalists', [
							'categorySlug' => $record->category_slug,
							'countrySlug' => $record->location_slug,
						])
					)
					/* ->url(fn (TopJournalist $record): string => route('top-journalists', [
							'categorySlug' => $record->category_slug,
							'countrySlug' => $record->location_slug,
						])
					)
					->openUrlInNewTab() */
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
            'index' => Pages\ListTopJournalists::route('/'),
            'create' => Pages\CreateTopJournalist::route('/create'),
            'edit' => Pages\EditTopJournalist::route('/{record}/edit'),
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
