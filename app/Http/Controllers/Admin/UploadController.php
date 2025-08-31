<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    public function uploadImage(Request $request)
    {
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('uploads/tinymce', 'public'); // uploads/tinymce в storage/app/public
            return response()->json(['location' => asset('storage/'.$path)]);
        }
        return response()->json(['error' => 'No file uploaded.'], 400);
    }
}
