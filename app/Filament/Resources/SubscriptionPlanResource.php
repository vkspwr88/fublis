<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubscriptionPlanResource\Pages;
use App\Filament\Resources\SubscriptionPlanResource\RelationManagers;
use App\Models\SubscriptionPlan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubscriptionPlanResource extends Resource
{
    protected static ?string $model = SubscriptionPlan::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

	public static function canAccess(): bool
	{
		return auth()->user()->hasRole('Super Admin');
	}

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('currency')
                    ->required()
					->options([
						'USD' => 'USD',
						'INR' => 'INR',
					])
					->default('USD'),
				Forms\Components\Select::make('symbol')
                    ->required()
					->options([
						'$' => '$',
						'₹' => '₹',
					])
					->default('$'),
                Forms\Components\TextInput::make('plan_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('plan_type')
                    ->required()
                    ->maxLength(255)
                    ->default('monthly'),
                Forms\Components\TextInput::make('plan_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price_per_month')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('quantity')
					->numeric()
					->default(1)
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
                Tables\Columns\TextColumn::make('currency'),
				Tables\Columns\TextColumn::make('symbol'),
                Tables\Columns\TextColumn::make('plan_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('plan_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('plan_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price_per_month')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
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
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ManageSubscriptionPlans::route('/'),
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
