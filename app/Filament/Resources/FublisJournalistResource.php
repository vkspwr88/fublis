<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FublisJournalistResource\Pages;
use App\Filament\Resources\FublisJournalistResource\RelationManagers;
use App\Http\Controllers\Users\JournalistController;
use App\Models\FublisJournalist;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FublisJournalistResource extends Resource
{
    protected static ?string $model = FublisJournalist::class;

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
                Forms\Components\Select::make('journalist_id')
					->label('Journalist')
                    // ->relationship('journalist', 'id')
					->options(JournalistController::getAll()->pluck('user.name', 'id'))
                    ->required()
					->searchable()
					->preload()
					->loadingMessage('Loading journalists...')
					->noSearchResultsMessage('No journalists found.')
					->searchingMessage('Searching journalists...')
					->unique(ignoreRecord: true),
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
                Tables\Columns\TextColumn::make('journalist.user.name')
                    ->searchable(),
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
            'index' => Pages\ManageFublisJournalists::route('/'),
        ];
    }
}
