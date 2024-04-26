<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TrixFileUploadController extends Controller
{
    public function upload(Request $request)
    {
        // dd($request->file);
		$path = FileController::upload($request->file, 'images/trix-editor/' . auth()->id(), 'trix_editor_attachment');
		$url = Storage::url($path);
		return [
            'href' => $url,
            'url' => $url,
        ];
    }

	public function remove(Request $request)
    {
        // dd($request->all());
		/* try{
			if(Str::contains($request->path, auth()->id())){
				$fileName = Str::afterLast($request->path, '/');
				$path = 'images/trix-editor/' . auth()->id() . '/' . $fileName;
				// dd($path);
				Storage::delete($path);
				return 'deleted';
			}
		}
		catch(Exception $exp){
			return $exp->getMessage();
		} */
    }
}
