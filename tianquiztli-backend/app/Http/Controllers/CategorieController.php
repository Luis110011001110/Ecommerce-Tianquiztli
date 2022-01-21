<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Categorie;

class CategorieController extends Controller
{
    //Get all categories and search categories by params
    public function index($text=null){
        $categories = DB::table('categories')
                            ->where(function ($query) use($text){
                                if($text != null){
                                    $query->where('categories.category', 'like', '%'. $text. '%')
                                    ->orWhere('categories.description', 'like', '%'. $text. '%');
                                }
                            })->select('categories.*')->get();

        return response()->json([
            "categories" => $categories
        ], 200, []);
    }

    //Create categorie
    public function store(Request $request){
        $categorie = new Categorie();
        $categorie->category = $request->category;
        $categorie->description = $request->description;
        $categorie->save();

        return response()->json([
            "message" => "Categorie created",
            "categorie" => $categorie
        ], 201, []);
    }

    //Edit categorie
    public function edit(Request $request, $categorieId){
        $categorie = Categorie::findOrFail($categorieId);
        $categorie->category = $request->category;
        $categorie->description = $request->description;
        $categorie->save();

        return response()->json([
            "message" => "Categorie edited",
            "categorie" => $categorie
        ], 200, []);
    }

    //Get categrie by ID
    public function show($categorieId){
        $categorie = Categorie::findOrFail($categorieId);

        return response()->json([
            "categorie" => $categorie
        ], 200, []);
    }
}
