<?php

namespace App\Filament\Resources;

use App\Enums\Users\UserTypeEnum;
use App\Filament\Resources\InterviewResource\Pages;
use App\Filament\Resources\InterviewResource\RelationManagers;
use App\Models\Interview;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InterviewResource extends Resource
{
    protected static ?string $model = Interview::class;

	protected static ?string $recordRouteKeyName = 'slug';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user')
					->options(User::where('user_type', '!=', 'admin')->orderBy('email')->get()->pluck('email', 'id'))
					->searchable()
					->preload()
                    ->required(),
                Forms\Components\TextInput::make('slug')
                    ->required()
					->unique()
                    ->maxLength(255),
                Forms\Components\Textarea::make('heading')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('final_submission')
					->label('For Submitted')
					->inline(false)
					->hidden(fn (string $operation) => $operation == 'create' || $operation == 'edit'),
                Forms\Components\TextInput::make('profile_pic_path')
                    ->maxLength(255)
					->hidden(fn (string $operation) => $operation == 'create' || $operation == 'edit'),
				Forms\Components\DateTimePicker::make('submission_date')
					->hidden(fn (string $operation) => $operation == 'create' || $operation == 'edit'),

				Forms\Components\Fieldset::make('')
					->schema([
						Forms\Components\Repeater::make('interviewQuestions')
							->relationship()
							->schema([
								Forms\Components\Textarea::make('question')
									->required(),
								Forms\Components\Textarea::make('answer')
									->hidden(fn (string $operation) => $operation == 'create' || $operation == 'edit'),
							])
							->reorderable(true)
							->reorderableWithButtons()
							->defaultItems(1)
							->addActionLabel('Add Question')
							->columns([1, 2])
							->columnSpanFull()

							/* ->columns(2)
							->columnSpan(2) */
						]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                /* Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(), */
				Tables\Columns\TextColumn::make('url')
					->state(function (Interview $record): string {
						// dd($record->user);
						if($record->user->user_type == UserTypeEnum::ARCHITECT){
							return route('architect.interview.index', [
								'interview' => $record->slug,
							]);
						}
						elseif($record->user->user_type == UserTypeEnum::JOURNALIST){
							return route('journalist.interview.index', [
								'interview' => $record->slug,
							]);
						}
					})
					->icon('heroicon-m-globe-alt')
					->iconColor('primary')
					->copyable()
					->copyMessage('Url copied')
					->copyMessageDuration(1500),
				Tables\Columns\TextColumn::make('heading')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
				Tables\Columns\TextColumn::make('user.email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
				Tables\Columns\IconColumn::make('final_submission')
                    ->boolean(),
                Tables\Columns\ImageColumn::make('profile_pic_path')
					->label('Profile Image')
					->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('submission_date')
                    ->dateTime()
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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListInterviews::route('/'),
            'create' => Pages\CreateInterview::route('/create'),
            'view' => Pages\ViewInterview::route('/{record}'),
            'edit' => Pages\EditInterview::route('/{record}/edit'),
        ];
    }
}
