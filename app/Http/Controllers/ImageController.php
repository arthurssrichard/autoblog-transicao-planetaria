<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageController extends Controller
{
    public function optimizedImage($filename){
        $path = storage_path('app/public/uploads/assetImages/' . $filename);
        
        if (!file_exists($path)) {
            abort(404);
        }

        $manager = new ImageManager(new Driver());

        $image = $manager->read($path);
        $image->scaleDown(300);
        $image->toPng();
        $image = $image->encode();
        

        return response($image)->header('Content-type','image/png');
    }
}
