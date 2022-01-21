<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Artisan;

class ArtisanController extends Controller
{
    //Get all artisans and search artisans by params
    public function index($text=null){
        $artisans = DB::table('artisans')
                        ->where(function ($query) use($text){
                            if($text != null){
                                $query->where('artisans.shop_name', 'like', '%'. $text .'%')
                                ->orWhere('artisans.shop_desc', 'like', '%'. $text .'%');
                            }
                        })->select('artisans.*')->get();

        return response()->json([
            "artisans" => $artisans
        ], 200, []);
    }

    //Create artisan
    public function store(Request $request){
        $artisan = new Artisan();
        $artisan->shop_name = $request->shop_name;
        $artisan->shop_desc = $request->shop_desc;
        $artisan->save();

        return response()->json([
            "message" => "Artisan created",
            "artisan" => $artisan
        ], 201, []);
    }

    //Edit artisan
    public function edit(Request $request, $artisanId){
        $artisan = Artisan::findOrFail($artisanId);
        $artisan->shop_name = $request->shop_name;
        $artisan->shop_desc = $request->shop_desc;
        $artisan->save();

        return response()->json([
            "message" => "artisan edited",
            "artisan" => $artisan
        ], 200, []);
    }

    //Get artisan by ID
    public function show($artisanId){
        $artisan = Artisan::findOrFail($artisanId);

        return response()->json([
            "artisan" => $artisan
        ], 200, []);
    }
}
