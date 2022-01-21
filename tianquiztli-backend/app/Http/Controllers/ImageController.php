<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Image;

class ImageController extends Controller
{
    //Get all images and seacrh images by param
    public function index($productId, $text=null){
        $images = DB::table('images')
                        ->leftJoin('products', 'products.id', '=', 'images.id_product')
                        ->where(function ($query) use ($productId){
                            if($productId != -1){
                                $query->where('products.id', '=', $productId);
                            }
                        })
                        ->where(function ($query) use ($text){
                            if($text != null){
                                $query->where('images.img_name', 'like', '%'. $text. '%');
                            }
                        })->selec('images.*')->get();
        
        return response()->json([
            "images" => $images
        ], 200, []);
    }

    //Create image 
    public function store(Request $request, $productId){
        $image = new Image();
        $image->id_product = $productId;
        $image->img_name = $request->img_name;
        $image->save();

        return response()->json([
            "message" => "image created",
            "response" => $image
        ], 201, []);
    }

    //Edit image
    public function edit(Request $request, $imageId){
        $image = Image::findOrFail($imageId);
        $image->img_name = $request->img_name;
        $image->save();

        return response()->json([
            "message" => "image edited",
            "response" => $image
        ], 200, []);
    }

    public function delete($imageId){
        Image::destroy($imageId);

        return response()->json([
            "message" => "image deleted"
        ], 200, []);
    }
    //Get image by ID
    public function show($imageId){
        $image = Image::findOrFail($imageId);

        return response()->json([
            "image" => $image
        ], 200, []);
    }
}
