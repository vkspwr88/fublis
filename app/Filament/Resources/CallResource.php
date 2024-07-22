<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CallResource\Pages;
use App\Filament\Resources\CallResource\RelationManagers;
use App\Http\Controllers\Admin\CallController;
use App\Http\Controllers\Users\LocationController;
use App\Models\Call;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CallResource extends Resource
{
    protected static ?string $model = Call::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
	protected static ?string $label = 'List';

	public static function canAccess(): bool
	{
		return auth()->user()->hasRole('Super Admin');
	}

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                /* Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255), */
                Forms\Components\Select::make('journalist_id')
                    ->relationship('journalist', 'slug')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
				Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
				Forms\Components\Select::make('location_id')
					->label('Location')
					->options(LocationController::getCountries()->pluck('name', 'name'))
					->searchable()
					->preload()
					->required(),
                /* Forms\Components\Select::make('location_id')
                    ->relationship('location', 'name')
                    ->required(), */
                Forms\Components\Select::make('publication_id')
                    ->relationship('publication', 'name')
                    ->required(),
                Forms\Components\Select::make('language_id')
                    ->relationship('language', 'name')
                    ->required(),
                Forms\Components\Select::make('publish_from_id')
                    ->relationship('publishFrom', 'name')
                    ->required(),
                Forms\Components\DatePicker::make('submission_end_date')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                /* Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(), */
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('journalist.slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('publication.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('language.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('publishFrom.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('submission_end_date')
                    ->date()
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
            ->actions([
                Tables\Actions\ViewAction::make()
											->mutateRecordDataUsing(function (array $data): array {
												$data = CallController::mutateFormDataBeforeFill($data);
												// dd($data);
												return $data;
											}),
                Tables\Actions\EditAction::make()
											->mutateRecordDataUsing(function (array $data): array {
												$data = CallController::mutateFormDataBeforeFill($data);
												// dd($data);
												return $data;
											})
											->using(function (Model $record, array $data): Model {
												return CallController::update($record, $data);
											}),
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
            'index' => Pages\ManageCalls::route('/'),
        ];
    }
}
