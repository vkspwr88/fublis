<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
				CuratorPicker::make('cover_image_path')
					->label('Cover Image (800 x 400)')
					->buttonLabel('Select Cover Image')
                    ->acceptedFileTypes(['image/*'])
					->columnSpanFull()
					->directory('images/articles/cover-images')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('text_credits')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('preview_text')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('article_doc_path')
					->directory('documents/articles')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('article_doc_link')
                    ->maxLength(65535)
                    ->columnSpanFull(),
				TiptapEditor::make('article_writeup')
					->tools(['heading', 'hr', 'bold', 'italic', 'bullet-list', 'ordered-list', 'lead', 'small', 'blockquote',])
					->extraInputAttributes(['style' => 'min-height: 12rem;'])
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('company_profile_path')
					->directory('documents/articles/company-profiles')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('company_profile_link')
                    ->maxLength(65535)
                    ->columnSpanFull(),
				Forms\Components\FileUpload::make('images')
					->directory('images/articles/images')
					->multiple()
					->reorderable()
					->appendFiles()
					->openable()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('images_link')
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
                Tables\Columns\TextColumn::make('text_credits')
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'view' => Pages\ViewArticle::route('/{record}'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
