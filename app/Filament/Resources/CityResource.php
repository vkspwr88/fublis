<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CityResource\Pages;
use App\Filament\Resources\CityResource\RelationManagers;
use App\Models\City;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CityResource extends Resource
{
    protected static ?string $model = City::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
					->required()
					->maxLength(255),
				Forms\Components\Select::make('state_id')
                    ->relationship('state', 'name')
					->searchable()
					->preload()
                    ->required(),
				Forms\Components\Radio::make('status')
					->required()
					->options([
						'active' => 'Active',
						'inactive' => 'Inactive',
					]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
				Tables\Columns\TextColumn::make('id')
					->label('ID')
					->searchable(),
				Tables\Columns\TextColumn::make('name')
					->formatStateUsing(fn (string $state): string => ucfirst($state))
					->searchable(),
				Tables\Columns\TextColumn::make('state.name')
					->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->searchable(),
				Tables\Columns\TextColumn::make('state.country.name')
					->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->searchable(),
				Tables\Columns\TextColumn::make('status')
					->badge()
					->color(fn (string $state): string => match ($state) {
						'active' => 'success',
						'inactive' => 'danger',
					})
					->searchable(),
            ])
			->defaultGroup('state.name')
			->groups([
				'state.name',
				'state.country.name',
			])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ManageCities::route('/'),
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
