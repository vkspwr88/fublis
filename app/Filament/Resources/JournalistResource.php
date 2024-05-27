<?php

namespace App\Filament\Resources;

use App\Enums\Users\UserTypeEnum;
use App\Filament\Resources\JournalistResource\Pages;
use App\Filament\Resources\JournalistResource\RelationManagers;
use App\Http\Controllers\Users\LocationController;
use App\Models\Journalist;
use App\Models\User;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class JournalistResource extends Resource
{
    protected static ?string $model = Journalist::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
	protected static ?string $label = 'List';
	protected static ?string $recordRouteKeyName = 'slug';

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
				Forms\Components\TextInput::make('display_first')
					->numeric()
					->default(999),
				Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
					->options(function(string $operation, Get $get) {
						// dd($operation, $get('user_id'));
						$users = User::doesntHave('journalist')->where('user_type', '!=', UserTypeEnum::ARCHITECT)->where('user_type', '!=', UserTypeEnum::ADMIN)->get();
						if($operation == 'edit' || $operation == 'view'){
							$user = User::where('id', $get('user_id'))->get();
							// $user = User::find($get('user_id'));
							// dd($get('user_id'), $user);
							$users = $users->merge($user);
							// dd($users);
						}
						return $users->pluck('email', 'id');
					})
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
							->revealable()
							->maxLength(255),
						Forms\Components\Select::make('user_type')
							->required()
							->options([
								'journalist' => 'Journalist'
							])
							->default('journalist'),
					])
                    ->required(),
				Forms\Components\Select::make('journalist_position_id')
					->required()
					->relationship('position', 'name'),
				Forms\Components\Repeater::make('journalistPublications')
					->columnSpanFull()
					->relationship()
					->schema([
						Forms\Components\Select::make('publication_id')
							->relationship('publication', 'name')
							->required(),
						Forms\Components\Select::make('journalist_position_id')
							->relationship('journalistPosition', 'name')
							->required(),
					])
					->columns(2),
				Forms\Components\TextInput::make('linked_profile')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('published_article_link')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('publishing_platform_link')
                    ->columnSpanFull(),
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
                Forms\Components\Select::make('language_id')
                    ->relationship('language', 'name'),
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
				Tables\Columns\TextInputColumn::make('display_first')
					->rules(['numeric'])
                    ->sortable(),
				Tables\Columns\ImageColumn::make('profileImage.image_path')
					->label('Profile Image'),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('position.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('language.name')
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
            'index' => Pages\ListJournalists::route('/'),
            'create' => Pages\CreateJournalist::route('/create'),
            'view' => Pages\ViewJournalist::route('/{record}'),
            'edit' => Pages\EditJournalist::route('/{record}/edit'),
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
