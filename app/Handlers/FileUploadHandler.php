<?php

namespace App\Handlers;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class FileUploadHandler
{

    public function handle(Request $request)
    {
        // dd(collect($request->file('files')));
        // dd($request->file('files'), $request->all(), storage_path('livewire-tmp'));
        // if(tenant()){
		$paths = collect($request->file('files'))->map(function ($file) {
			// dd($i);
			$filename = TemporaryUploadedFile::generateHashNameWithOriginalNameEmbedded($file);
			dd($file, $filename);
			return $file->storeAs('livewire-tmp', $filename);
			// return $file->store('livewire-tmp');
		})->toArray();
        // }
        dd($paths);
        return json_encode([
            'paths' => $paths,
        ]);
        // return $next($request);
    }


}
