<?php

namespace App\Filament\Resources;

use App\Enums\Affiliates\ReturnTypeEnum;
use App\Filament\Resources\AffListResource\Pages;
use App\Filament\Resources\AffListResource\RelationManagers;
use App\Models\AffList;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AffListResource extends Resource
{
    protected static ?string $model = AffList::class;

	protected static ?string $label = 'Approved List';

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('aff_registration_id')
                    ->relationship('affRegistration', 'id')
                    ->required(),
                Forms\Components\TextInput::make('username')
                    ->required()
					->unique(ignoreRecord:true)
                    ->maxLength(255),
                Forms\Components\Select::make('return_type')
                    ->required()
                    // ->default('fixed')
					->options(ReturnTypeEnum::class),
                Forms\Components\TextInput::make('return_value')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                /* Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(), */
                Tables\Columns\TextColumn::make('affRegistration.user.email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('username')
                    ->searchable(),
                Tables\Columns\TextColumn::make('return_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('return_value')
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
            'index' => Pages\ManageAffLists::route('/'),
        ];
    }
}
