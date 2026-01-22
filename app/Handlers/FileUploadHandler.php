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
		$paths = collect($request->file('files'))->map(function ($file) {
			// $filename = TemporaryUploadedFile::generateHashNameWithOriginalNameEmbedded($file);
			// $filename = uniqid() . '.' . $file->getClientOriginalExtension();
			$hash = str()->random(30);
			$meta = str('-meta'.base64_encode(uniqid()).'-')->replace('/', '_');
			$extension = '.'.$file->getClientOriginalExtension();
			$filename = $hash.$meta.$extension;
			// dd($file, $filename);
			$file->storeAs('livewire-tmp', $filename);
			return $filename;
			// return $file->store('livewire-tmp');
		})->toArray();
        // dd($paths);
        return json_encode([
            'paths' => $paths,
        ]);
    }
}
