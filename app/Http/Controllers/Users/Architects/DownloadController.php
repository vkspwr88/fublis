<?php

namespace App\Http\Controllers\Users\Architects;

use App\Http\Controllers\Controller;
use App\Models\MediaKit;
use App\Services\DownloadService;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
	private DownloadService $downloadService;

	public function __construct(
		DownloadService $downloadService,
	)
	{
		$this->downloadService = $downloadService;
	}

    public function index(MediaKit $mediaKit, Request $request)
	{
		return $this->downloadService->singleFileDownload($request->file);
	}

	public function bulk(MediaKit $mediaKit, Request $request)
	{
		return $this->downloadService->zipFilesDownload($mediaKit, $request->file);
	}
}
