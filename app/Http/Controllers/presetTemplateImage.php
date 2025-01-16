<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class presetTemplateImage extends Controller
{
    public static function getImage()
    {

        $imagePath = Storage::disk('public')->files();

        foreach ($imagePath as $imageFullpath) {
            // $file_path = Storage::url($imageFullpath);
            // $url = asset($file_path);
            $urls[] = storage_path($imageFullpath);
            //testing files variable
            $files = $urls;
        }

        // return view('filament.app.pages.certificate-designer', compact('files'));
    }
}
