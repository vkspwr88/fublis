<?php

namespace App\Filament\Resources;

use App\Enums\Users\Architects\UserRoleEnum;
use App\Enums\Users\UserTypeEnum;
use App\Filament\Resources\ArchitectResource\Pages;
use App\Filament\Resources\ArchitectResource\RelationManagers;
use App\Http\Controllers\Users\ArchitectController;
use App\Http\Controllers\Users\CompanyController;
use App\Http\Controllers\Users\LocationController;
use App\Models\Architect;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class ArchitectResource extends Resource
{
    protected static ?string $model = Architect::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
	protected static ?string $label = 'List';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
				Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
					->options(User::doesntHave('architect')->where('user_type', '!=', UserTypeEnum::JOURNALIST)->where('user_type', '!=', UserTypeEnum::ADMIN)->get()->pluck('email', 'id'))
					->createOptionForm([
						Forms\Components\TextInput::make('name')
							->required()
							->maxLength(255),
						Forms\Components\TextInput::make('email')
							->email()
							->unique()
							->required()
							->maxLength(255),
						Forms\Components\DateTimePicker::make('email_verified_at')
							->seconds(false)
							->default(now()),
						Forms\Components\TextInput::make('password')
							->password()
							->required()
							->maxLength(255),
						Forms\Components\Select::make('user_type')
							->required()
							->options(['architect'])
							->default('architect'),
					])
                    ->required(),
				Forms\Components\Select::make('user_role')
                    ->required()
                    ->options(UserRoleEnum::class),
                Forms\Components\Select::make('company_id')
					->label('Studio')
					->searchable()
                    ->relationship('company', 'name')
                    ->required(),
                Forms\Components\Select::make('architect_position_id')
                    ->required()
					->searchable()
                    ->relationship('position', 'name'),
                Forms\Components\Select::make('country')
					->label('Country')
					->live()
					->options(LocationController::getCountries()->pluck('name', 'id'))
					->default(101)
					->searchable()
					->required(),
				Forms\Components\Select::make('state')
					->label('State')
					->live()
					->options( fn (Get $get): Collection => LocationController::getStatesByCountryId($get('country'))->pluck('name', 'id') )
					->default(0)
					->searchable()
					->required(),
				Forms\Components\Select::make('location_id')
					->label('City')
					->options( fn (Get $get): Collection => LocationController::getCitiesByStateId($get('state'))->pluck('name', 'id') )
					->default(0)
					->searchable()
					->required(),
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
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company.name')
					->label('Studio')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user_role')
                    ->searchable(),
                Tables\Columns\TextColumn::make('position.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location.name')
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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListArchitects::route('/'),
            'create' => Pages\CreateArchitect::route('/create'),
            'view' => Pages\ViewArchitect::route('/{record}'),
            'edit' => Pages\EditArchitect::route('/{record}/edit'),
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
