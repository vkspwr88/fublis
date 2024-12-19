<?php

namespace App\Filament\Resources;

use App\Enums\Users\UserTypeEnum;
use App\Filament\Resources\DownloadRequestScheduleResource\Pages;
use App\Filament\Resources\DownloadRequestScheduleResource\RelationManagers;
use App\Models\DownloadRequestSchedule;
use App\Models\MediaKit;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DownloadRequestScheduleResource extends Resource
{
    protected static ?string $model = DownloadRequestSchedule::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

	public static function canAccess(): bool
	{
		$user = User::find(auth()->id());
		return $user->hasRole('Super Admin');
	}

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                /* Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(), */
				Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
					->options(function(string $operation, Get $get) {
						// dd($operation, $get('user_id'));
						$users = User::has('journalist')->get();
						/* if($operation == 'edit' || $operation == 'view'){
							$user = User::where('id', $get('user_id'))->get();
							// $user = User::find($get('user_id'));
							// dd($get('user_id'), $user);
							$users = $users->merge($user);
							// dd($users);
						} */
						return $users->pluck('name', 'id');
					})
					->searchable()
					->preload()
					->required(),
                Forms\Components\Select::make('media_kit_id')
                    ->relationship('mediaKit', 'id')
					->options(function(string $operation, Get $get) {
						// dd($operation, $get('user_id'));
						$mediaKits = MediaKit::has('story')->get();
						/* if($operation == 'edit' || $operation == 'view'){
							$user = User::where('id', $get('user_id'))->get();
							// $user = User::find($get('user_id'));
							// dd($get('user_id'), $user);
							$users = $users->merge($user);
							// dd($users);
						} */
						return $mediaKits->pluck('story.title', 'id');
					})
					->searchable()
					->preload()
                    ->required(),
                Forms\Components\DateTimePicker::make('schedule_at')
                    ->required(),
                /* Forms\Components\Toggle::make('is_mail_sent')
                    ->required(), */
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                /* Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(), */
				Tables\Columns\TextColumn::make('index')
                    ->label('S.N.')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mediaKit.story.title')
					->label('Media Kit')
                    ->searchable(),
                Tables\Columns\TextColumn::make('schedule_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_mail_sent')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
			->defaultSort('schedule_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ManageDownloadRequestSchedules::route('/'),
        ];
    }
}
