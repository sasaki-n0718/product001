<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attachment;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function download(Request $request,Attachment $attachment){
        $file=$attachment->find($request->id);
        $mimetype=Storage::mimetype($file->path);
        $headers=[['Content-Type'=>$mimetype]];
        return Storage::download($file->path,$file->name, $headers);
    }
}
