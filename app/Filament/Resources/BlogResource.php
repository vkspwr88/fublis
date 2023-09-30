<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Filament\Resources\BlogResource\RelationManagers;
use App\Models\Blog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use RalphJSmit\Filament\SEO\SEO;

use FilamentTiptapEditor\TiptapEditor;
use FilamentTiptapEditor\Enums\TiptapOutput;
use Awcodes\Curator\Components\Forms\CuratorPicker;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
	protected static ?string $navigationGroup = 'Blogs';
    protected static ?string $navigationLabel  = 'Posts';
	protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make([
					'default' => 1,
    				'sm' => 3,
				])
				->schema([
					Forms\Components\Fieldset::make('Blog')
						->schema([
							Forms\Components\TextInput::make('title')
								->required()
								->live(onBlur: true)
								->afterStateUpdated(function(string $operation, $state, Set $set){
									if($operation !== 'create' && $operation !== 'edit'){
										return;
									}
									$set('slug', Str::slug($state));
								}),
							Forms\Components\TextInput::make('slug')
								->required()
								->unique(Blog::class, 'slug', ignoreRecord: true),
							Forms\Components\TextInput::make('author')
								->required(),
							Forms\Components\DatePicker::make('published_date')
								->required(),
							CuratorPicker::make('home_image_id')
								->label('Blog Home Imge (550 x 400)')
								->buttonLabel('Select Blog Home Image')
								->relationship('homeImage', 'id')
								->columnSpanFull()
								->required()
								->acceptedFileTypes(['image/*']),
							CuratorPicker::make('banner_image_id')
								->label('Blog Banner Image (1320 x 560)')
								->buttonLabel('Select Blog Banner Image')
								->relationship('bannerImage', 'id')
								->columnSpanFull()
								->required()
								->acceptedFileTypes(['image/*']),
							Forms\Components\Textarea::make('description')
								->required()
								->columnSpanFull(),
							/* Forms\Components\RichEditor::make('body')
								->label('Content')
								->required()
								->fileAttachmentsDisk('public')
								->fileAttachmentsDirectory('images/blogs')
								->columnSpanFull(), */
							TiptapEditor::make('body')
								->label('Content')
								->profile('default')
								//->profile('default|simple|minimal|none|custom')
								//->tools([]) // individual tools to use in the editor, overwrites profile
								//->disk('string') // optional, defaults to config setting
								//->directory('string or Closure returning a string') // optional, defaults to config setting
								//->acceptedFileTypes(['array of file types']) // optional, defaults to config setting
								//->maxFileSize('integer in KB') // optional, defaults to config setting
								//->output(TiptapOutput::Html) // optional, change the format for saved data, default is html
								//->maxContentWidth('5xl')
								->required()
								->columnSpanFull()

						])
						->columnSpan(3),

					Forms\Components\Fieldset::make('SEO')
						->schema([
							SEO::make(),
							CuratorPicker::make('seo_image_id')
								->label(__('filament-seo::translations.image'))
								->buttonLabel('Select Image')
								->relationship('seoImage', 'id')
								->columnSpan(2)
								->acceptedFileTypes(['image/*'])
							])
						->columns(1)
						->columnSpan(2),

					Forms\Components\Grid::make()
						->schema([
							Forms\Components\Fieldset::make('Categories')
								->schema([
									Forms\Components\Select::make('categories')
										->label('Select')
										->multiple()
										->relationship(name: 'categories', titleAttribute: 'name')
										->searchable()
    									->preload()
										->loadingMessage('Loading categories...')
										->noSearchResultsMessage('No categories found.')
										->searchingMessage('Searching categories...')
										->createOptionForm([
											Forms\Components\TextInput::make('name')
												->required()
												->unique(),
										])
								])
								//->columnSpan(1)
								->columns(1),

							Forms\Components\Fieldset::make('Industries')
								->schema([
									Forms\Components\Select::make('industries')
										->label('Select')
										->multiple()
										->relationship(name: 'industries', titleAttribute: 'name')
										->searchable()
    									->preload()
										->loadingMessage('Loading industries...')
										->noSearchResultsMessage('No industries found.')
										->searchingMessage('Searching industries...')
										->createOptionForm([
											Forms\Components\TextInput::make('name')
												->required()
												->unique(),
										])
								])
								//->columnSpan(1)
								->columns(1),

							Forms\Components\Fieldset::make('Tags')
								->schema([
									Forms\Components\Select::make('tags')
										->label('Select')
										->multiple()
										->relationship(name: 'tags', titleAttribute: 'name')
										->searchable()
    									->preload()
										->loadingMessage('Loading tags...')
										->noSearchResultsMessage('No tags found.')
										->searchingMessage('Searching tags...')
										->createOptionForm([
											Forms\Components\TextInput::make('name')
												->required()
												->unique(),
										])
								])
								//->columnSpan(1)
								->columns(1),
						])
						//->columns(3)
						->columnSpan(1)

				])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
					->label('Blog Title'),
                Tables\Columns\TextColumn::make('slug')
					->label('Blog Slug'),
                Tables\Columns\TextColumn::make('categories.name')
					->listWithLineBreaks()
					->bulleted(),
                Tables\Columns\TextColumn::make('industries.name')
					->listWithLineBreaks()
					->bulleted(),
                Tables\Columns\TextColumn::make('tags.name')
					->listWithLineBreaks()
					->bulleted(),
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
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
					->label(__('admin/blogs.create.button_text')),
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'view' => Pages\ViewBlog::route('/{record}'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
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
