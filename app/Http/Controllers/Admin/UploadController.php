<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function imageUpload(Request $request) {

        $request->validate([
            'file' => 'required|image|mimes:jpeg,jpg,png'
        ]);

        $imageName = time().'.'.$request->file->extension();

        //Caminha a ser salvo a Image
        $request->file->move(public_path('media/images'), $imageName);

        return [
            'location' => asset('media/images/'.$imageName) 
        ];

    }
}
