<?php

namespace App\Filament\Resources;

use App\Enums\Users\Architects\MediaKits\RequestStatusEnum;
use App\Filament\Resources\MediaKitResource\Pages;
use App\Filament\Resources\MediaKitResource\RelationManagers;
use App\Models\MediaKit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MediaKitResource extends Resource
{
    protected static ?string $model = MediaKit::class;

	protected static ?string $label = 'Download Requests';
	protected static ?string $navigationLabel = 'Download Requests';

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('slug')
                //     ->required()
                //     ->maxLength(255),
                // Forms\Components\Select::make('architect_id')
                //     ->relationship('architect', 'id')
                //     ->required(),
                // Forms\Components\Textarea::make('audio_video_url')
                //     ->maxLength(65535)
                //     ->columnSpanFull(),
                // Forms\Components\TextInput::make('story_type')
                //     ->required()
                //     ->maxLength(255),
                // Forms\Components\TextInput::make('story_id')
                //     ->required()
                //     ->maxLength(36),
                // Forms\Components\Select::make('category_id')
                //     ->relationship('category', 'name')
                //     ->required(),
                // Forms\Components\Select::make('media_contact_id')
                //     ->relationship('mediaContact', 'id')
                //     ->required(),
                // Forms\Components\Select::make('project_access_id')
                //     ->relationship('projectAccess', 'name')
                //     ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('id')
                //     ->label('ID')
                //     ->searchable(),
				Tables\Columns\TextColumn::make('index')
					->label('S.N.')
    				->rowIndex(),
                /* Tables\Columns\TextColumn::make('slug')
                    ->searchable(), */
                Tables\Columns\TextColumn::make('architect.user.name')
                    ->searchable()
					->sortable(),
                Tables\Columns\TextColumn::make('story.title')
					->label('Mediakit Title')
                    ->searchable()
					->sortable()
					->wrap(),
				// Tables\Columns\ColumnGroup::make('Download Requests', [
					Tables\Columns\TextColumn::make('download_requests_count')
						->label('Total Requests')
						->numeric()
						->counts('downloadRequests')
						->sortable(),
					Tables\Columns\TextColumn::make('approved_download_count')
						->label('Approved Requests')
						->numeric()
						->state(function (Model $record): int {
							return $record->downloadRequests()->where('request_status', RequestStatusEnum::APPROVED)->count();
						}),
					Tables\Columns\TextColumn::make('pending_download_count')
						->label('Pending Requests')
						->numeric()
						->state(function (Model $record): int {
							return $record->downloadRequests()->where('request_status', RequestStatusEnum::PENDING)->count();
						}),
					Tables\Columns\TextColumn::make('declined_download_count')
						->label('Declined Requests')
						->numeric()
						->state(function (Model $record): int {
							return $record->downloadRequests()->where('request_status', RequestStatusEnum::DECLINED)->count();
						}),
					// ])
					// ->alignment(Alignment::Center),
				// Tables\Columns\TextColumn::make('approved_download_requests_count')
				// 	->label('Total Approved Download Request')
				// 	->counts([
				// 		'downloadRequests' => fn (Builder $query) => $query->where('request_status', RequestStatusEnum::APPROVED->value),
				// 	]),
				// Tables\Columns\TextColumn::make('pending_download_requests_count')
				// 	->label('Total Pending Download Request')
				// 	->counts([
				// 		'downloadRequests' => fn (Builder $query) => $query->where('request_status', 'pending'),
				// 	]),
				// Tables\Columns\TextColumn::make('declined_download_requests_count')
				// 	->label('Total Declined Download Request')
				// 	->counts([
				// 		'downloadRequests' => fn (Builder $query) => $query->where('request_status', RequestStatusEnum::DECLINED),
				// 	]),
                Tables\Columns\TextColumn::make('story_type')
					->label('Mediakit Type')
					->state(function(Model $record) {
						return showModelName($record->story_type);
					})
                    ->searchable()
					->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->searchable()
					->sortable(),
                // Tables\Columns\TextColumn::make('mediaContact.id')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('projectAccess.name')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
			->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
			->groups([
				'architect.user.name',
			])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageMediaKits::route('/'),
        ];
    }
}
