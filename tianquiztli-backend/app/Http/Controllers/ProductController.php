<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;

class ProductController extends Controller
{
    //Get all Prodcuts and search products by params
    public function index($artisanId, $categorieId, $text=null){
        $product = DB::table('products')
                        ->join('artisans','artisans.id', '=', 'products.id_artisan')
                        ->join('categories','categories.id', '=', 'products.id_categorie')
                        ->where(function ($query) use ($artisanId){
                            if($artisanId != -1){
                                $query->where('artisans.id', "=", $artisanId);
                            }
                        })
                        ->where(function ($query) use ($categorieId){
                            if($categorieId != -1){
                                $query->where('categories.id', "=", $categorieId);
                            }
                        })
                        ->where(function ($query) use($text){
                            if($text != null){
                                $query->where('products.product_name','like', '%'. $text. '%')
                                ->orWhere('products.price', 'like', '%'. $text. '%')
                                ->orWhere('products.dimentions', 'like', '%'. $text. '%')
                                ->orWhere('products.product_weight', 'like', '%'. $text. '%')
                                ->orWhere('products.size', 'like', '%'. $text. '%')
                                ->orWhere('products.stock', 'like', '%'. $text. '%');
                            }
                        })->select('products.*','artisans.*','categories.*')->get();
        
        return response()->json([
            'products' => $product
        ], 200, []);
    }

    //Create product
    public function store(Request $request, $artisanId, $categorieId){
        $product = new Product();
        $product->id_artisan = $artisanId;
        $product->id_categorie = $categorieId;
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->dimentions = $request->dimentions;
        $product->product_weight = $request->product_weight;
        $product->size = $request->size;
        $product->stock = $request->stock;
        $product->save();

        return response()->json([
            "message" => "Product created",
            "response" => $product
        ],201, []);
    }

    //Edit product
    public function edit(Request $request, $productId){
        $product = Product::findOrFail($productId);
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->dimentions = $request->dimentions;
        $product->product_weight = $request->product_weight;
        $product->size = $request->size;
        $product->stock = $request->stock;
        $product->save();

        return response()->json([
            "message" => "Product edited",
            "response" => $product
        ], 200, []);
    }


    //Delete products
    public function delete($productId){
        Product::destroy($productId);

        return response()->json([
            "message" => "Product deleted"
        ], 200, []);
    } 

    //Get product bt ID
    public function show($productId){
        $product = Product::findOrFail($productId);

        return response()->json([
            "product" => $product
        ], 200, []);
    }
}
