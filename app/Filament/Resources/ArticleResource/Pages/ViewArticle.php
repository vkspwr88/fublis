<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use App\Models\Article;
use App\Services\DownloadService;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewArticle extends ViewRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
			Actions\ActionGroup::make([
				Actions\Action::make('download1')
					// ->icon('heroicon-m-arrow-down-tray')
					->label('Download Company Profile')
					->hidden(fn(Article $article) => !$article->company_profile_path)
					->action(
						function (Article $article) {
							$mediaKit = $article->mediaKit[0];
							$downloadService = new DownloadService;
							return $downloadService->singleFileDownload($mediaKit->slug, $article->company_profile_path, 'CompanyProfile');
						}
					),
				Actions\Action::make('download2')
					// ->icon('heroicon-m-arrow-down-tray')
					->label('Download Full Article')
					->hidden(fn(Article $article) => !$article->article_doc_path)
					->action(
						function (Article $article) {
							$mediaKit = $article->mediaKit[0];
							$downloadService = new DownloadService;
							return $downloadService->singleFileDownload($mediaKit->slug, $article->article_doc_path, 'FullArticle');
						}
					),
				Actions\Action::make('download3')
					// ->icon('heroicon-m-arrow-down-tray')
					->label('Download Photographs')
					->hidden(fn(Article $article) => $article->images->count() == 0)
					->action(
						function (Article $article) {
							$mediaKit = $article->mediaKit[0];
							$downloadService = new DownloadService;
							return $downloadService->zipFilesDownload($mediaKit, 'images', 'Photographs');
						}
					),
			]),
            Actions\EditAction::make(),
        ];
    }
}
