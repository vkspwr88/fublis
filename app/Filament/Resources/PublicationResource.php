<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PublicationResource\Pages;
use App\Filament\Resources\PublicationResource\RelationManagers;
use App\Http\Controllers\Admin\PublicationController;
use App\Http\Controllers\Users\LocationController;
use App\Models\Publication;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Components\Tab;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class PublicationResource extends Resource
{
    protected static ?string $model = Publication::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
	protected static ?string $label = 'List';

	public static function form(Form $form): Form
    {
        return $form
            ->schema([
				CuratorPicker::make('media_id')
					->label('Logo Image (400 x 400)')
					->buttonLabel('Select Logo Image')
                    ->acceptedFileTypes(['image/*'])
					->columnSpanFull()
					->imageCropAspectRatio('1:1')
					->maxWidth(400)
					// ->directory('images/publications/logos')
					// ->relationship('profile_image', 'imaggable')
                    ->required(fn (string $operation): bool => $operation != 'edit'),
               	Forms\Components\Toggle::make('is_premium')
					->inline(false)
					->default(false),
				Forms\Components\TextInput::make('display_first')
					->numeric()
					->default(999),
				Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
				Forms\Components\TextInput::make('website')
                    ->required()
                    ->maxLength(255),
				Forms\Components\Select::make('country')
					->label('Country')
					->live()
					->options(LocationController::getCountries()->pluck('name', 'id'))
					->default(101)
					->searchable()
					->required(),
				/* Forms\Components\Select::make('state')
					->label('State')
					->live()
					->options( fn (Get $get): Collection => LocationController::getStatesByCountryId($get('country'))->pluck('name', 'id') )
					->default(0)
					->searchable()
					->required(), */
				/* Forms\Components\Select::make('location_id')
					->label('City')
					->options( fn (Get $get): Collection => LocationController::getCitiesByStateId($get('state'))->pluck('name', 'id') )
					->default(0)
					->searchable()
					->required(), */
				Forms\Components\CheckboxList::make('categories')
					->required()
					->relationship(titleAttribute: 'name')
					->columns(2)
					->gridDirection('row'),
				Forms\Components\CheckboxList::make('publicationTypes')
					->required()
					->relationship(titleAttribute: 'name')
					->columns(2)
					->gridDirection('row'),
				Forms\Components\CheckboxList::make('languages')
					->relationship(titleAttribute: 'name')
					->required()
					->columns(2)
					->gridDirection('row'),
				Forms\Components\CheckboxList::make('publishFrom')
					->relationship(titleAttribute: 'name')
					->required()
					->columns(2)
					->gridDirection('row'),
				/* Forms\Components\TextInput::make('starting_year')
					->length(4)
					->numeric()
					->minValue(1900)
					->maxValue(date('Y')), */
               /*  Forms\Components\TextInput::make('instagram')
                    ->maxLength(255), */
                /* Forms\Components\TextInput::make('monthly_visitors')
                    ->maxLength(255), */
				Forms\Components\Textarea::make('about_me')
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
				Tables\Columns\ToggleColumn::make('is_premium')
					->sortable(),
				Tables\Columns\TextInputColumn::make('display_first')
					->rules(['numeric'])
                    ->sortable(),
				Tables\Columns\ImageColumn::make('profileImage.image_path')
					->label('Profile Image'),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('website')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location.name')
                    ->searchable(),
				Tables\Columns\TextColumn::make('categories.name')
					->listWithLineBreaks()
					->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
				Tables\Columns\TextColumn::make('publicationTypes.name')
					->listWithLineBreaks()
					->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
				Tables\Columns\TextColumn::make('languages.name')
					->listWithLineBreaks()
					->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
				Tables\Columns\TextColumn::make('publishFrom.name')
					->listWithLineBreaks()
					->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('starting_year')
                    // ->date()
					->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                /* Tables\Columns\TextColumn::make('instagram')
					->url(fn (Publication $record): string => $record->instagram)
					->openUrlInNewTab()
					->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(), */
                Tables\Columns\TextColumn::make('monthly_visitors')
					->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('about_me')
					->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('added_by')
					->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
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
                Tables\Actions\ViewAction::make()
											->mutateRecordDataUsing(function (array $data): array {
												$data = PublicationController::mutateFormDataBeforeFill($data);
												// dd($data);
												return $data;
											}),
                Tables\Actions\EditAction::make()
											->mutateRecordDataUsing(function (array $data): array {
												$data = PublicationController::mutateFormDataBeforeFill($data);
												// dd($data);
												return $data;
											})
											->using(function (Model $record, array $data): Model {
												return PublicationController::update($record, $data);
											}),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePublications::route('/'),
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
