<?php

namespace App\Filament\Resources;

use App\Enums\Affiliates\ApplicationStatusEnum;
use App\Enums\Affiliates\ReturnTypeEnum;
use App\Enums\Users\UserTypeEnum;
use App\Filament\Resources\AffRegistrationResource\Pages;
use App\Filament\Resources\AffRegistrationResource\RelationManagers;
use App\Models\AffRegistration;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AffRegistrationResource extends Resource
{
    protected static ?string $model = AffRegistration::class;

	protected static ?string $label = 'Registration';

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'email')
					->options(function(string $operation, Get $get) {
						$users = User::have('journalist')->where('user_type', '=', UserTypeEnum::JOURNALIST)->get();
						return $users->pluck('email', 'id');
					})
					->unique(ignoreRecord:true)
                    ->required(),
                Forms\Components\TextInput::make('publication_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('publication_url')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('how_will_you_promote_us')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\Select::make('application_status')
                    ->required()
                    // ->default('pending')
					->options(ApplicationStatusEnum::class),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('publication_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('publication_url')
					->url(fn (AffRegistration $record): string => $record->publication_url)
					->openUrlInNewTab()
					->searchable(),
                Tables\Columns\TextColumn::make('application_status')
					->badge()
					->color(fn (ApplicationStatusEnum $state): string => match ($state) {
						ApplicationStatusEnum::PENDING => 'warning',
						ApplicationStatusEnum::APPROVED => 'success',
						ApplicationStatusEnum::DECLINED => 'danger',
					})
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
				Tables\Actions\ActionGroup::make([
					Tables\Actions\Action::make('approved')
						->visible(function (AffRegistration $record) {
							return $record->application_status === ApplicationStatusEnum::PENDING;
						})
						->icon('heroicon-m-check')
						->color('success')
						->label('Approve')
						->requiresConfirmation()
						/* ->fillForm(fn (AffRegistration $record): array => [
							'username' => $record->user->journalist->slug,
						]) */
						->form([
							/* Forms\Components\TextInput::make('username')
								->required()
								->unique(ignoreRecord:true)
								->readOnly()
								->maxLength(255), */
							Forms\Components\Select::make('return_type')
								->required()
								// ->default('fixed')
								->options(ReturnTypeEnum::class),
							Forms\Components\TextInput::make('return_value')
								->required()
								->numeric(),
						])
						->action(function (array $data, AffRegistration $record): void {
							// dd($data, $record);
							$record->application_status = ApplicationStatusEnum::APPROVED;
							$record->save();
							$record->affList()->create([
								'username' => $record->user->journalist->slug,
								'return_type' => $data['return_type'],
								'return_value' => $data['return_value'],
							]);
							// $record->author()->associate($data['authorId']);
							// $record->save();
						})
						->slideOver()
						->successNotification(
							Notification::make()
								 ->success()
								 ->title('Application Approved')
								 ->body('The application has been approved successfully.')
						),
					Tables\Actions\Action::make('declined')
						->visible(function (AffRegistration $record) {
							return $record->application_status === ApplicationStatusEnum::PENDING;
						})
						->icon('heroicon-m-x-mark')
						->color('danger')
						->label('Decline')
						->requiresConfirmation()
						->action(function (array $data, AffRegistration $record): void {
							// dd($data, $record);
							$record->application_status = ApplicationStatusEnum::DECLINED;
							// $record->author()->associate($data['authorId']);
							$record->save();
						})
						->successNotification(
							Notification::make()
								 ->success()
								 ->title('Application Declined')
								 ->body('The application has been declined successfully.')
						),
					Tables\Actions\ViewAction::make(),
					Tables\Actions\EditAction::make(),
					Tables\Actions\DeleteAction::make(),
				]),
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
            'index' => Pages\ManageAffRegistrations::route('/'),
        ];
    }
}
