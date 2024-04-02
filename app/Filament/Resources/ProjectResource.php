<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Http\Controllers\Users\BuildingTypologyController;
use App\Http\Controllers\Users\BuildingUseController;
use App\Http\Controllers\Users\LocationController;
use App\Models\Project;
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

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
					->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\TextInput::make('site_area')
                    ->numeric(),
                Forms\Components\Select::make('site_area_id')
					->relationship('siteAreaUnit', 'name'),
                Forms\Components\TextInput::make('built_up_area')
                    ->numeric(),
                Forms\Components\Select::make('built_up_area_id')
					->relationship('builtUpAreaUnit', 'name'),
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
                Forms\Components\Select::make('project_status_id')
                    ->relationship('projectStatus', 'name')
                    ->required(),
                Forms\Components\TextInput::make('materials')
                    ->maxLength(255),
                Forms\Components\Select::make('building_typology_id')
					->options( fn (): Collection => BuildingTypologyController::getAll()->pluck('name', 'id') ),
                Forms\Components\Select::make('building_use_id')
					->options( fn (Get $get): Collection => BuildingUseController::getAllByTypologyId($get('building_typology_id'))->pluck('name', 'id') )
                    ->relationship('buildingUse', 'name'),
                Forms\Components\FileUpload::make('image_credits')
                    ->image(),
                Forms\Components\TextInput::make('text_credits')
                    ->maxLength(255),
                Forms\Components\TextInput::make('render_credits')
                    ->maxLength(255),
                Forms\Components\Textarea::make('consultants')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('design_team')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                /* Forms\Components\Textarea::make('cover_image_path')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(), */
				CuratorPicker::make('cover_image_path')
					->label('Cover Image (800 x 400)')
					->buttonLabel('Select Cover Image')
                    ->acceptedFileTypes(['image/*'])
					->columnSpanFull()
					->directory('images/projects/cover-images')
                    ->required(),
                Forms\Components\Textarea::make('project_brief')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                /* Forms\Components\Textarea::make('project_doc_path')
                    ->maxLength(65535)
                    ->columnSpanFull(), */
				Forms\Components\FileUpload::make('project_doc_path')
					->directory('documents/projects')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('project_doc_link')
                    ->maxLength(65535)
                    ->columnSpanFull(),
				Forms\Components\FileUpload::make('photographs')
					->directory('images/projects/photographs')
					->multiple()
					->reorderable()
					->appendFiles()
					->openable()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('photographs_link')
                    ->maxLength(65535)
                    ->columnSpanFull(),
				Forms\Components\FileUpload::make('drawings')
					->directory('images/projects/drawings')
					->multiple()
					->reorderable()
					->appendFiles()
					->openable()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('drawings_link')
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
				Tables\Columns\ImageColumn::make('cover_image_path'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('site_area')
					->toggleable(isToggledHiddenByDefault: true)
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('siteAreaUnit.name')
					->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('built_up_area')
					->toggleable(isToggledHiddenByDefault: true)
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('builtUpAreaUnit.name')
					->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('location.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('projectStatus.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('materials')
                    ->searchable(),
                Tables\Columns\TextColumn::make('building_typology_id')
					->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('buildingUse.name')
					->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_credits'),
                Tables\Columns\TextColumn::make('text_credits')
                    ->searchable(),
                Tables\Columns\TextColumn::make('render_credits')
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'view' => Pages\ViewProject::route('/{record}'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
