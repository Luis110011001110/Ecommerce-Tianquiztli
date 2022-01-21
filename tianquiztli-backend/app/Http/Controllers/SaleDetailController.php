<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\SaleDetail;

class SaleDetailController extends Controller
{
    //Get all sales_details and search sales_details by params
    public function index($saleId, $productId, $text=null){
        $sale_detail = DB::table('sale_details')
                        ->join('sales','sales.id', '=', 'sale_details.id_sale')
                        ->join('products','products.id', '=', 'sale_details.id_product')
                        ->where(function ($query) use ($saleId) {
                            if($saleId != -1){
                               $query->where('sale_details.id_sale', '=', $saleId);
                            }
                        })
                        ->where(function ($query) use ($productId) {
                            if($productId != -1){
                               $query->where('sale_details.id_product', '=', $productId);
                            }
                        })->select('sale_details.*','products.*')->get();

        return response()->json([
            "sale_detail" => $sale_detail
        ], 200, []);
    }

    //Create sale_details
    public function store(Request $request, $saleId, $productId){
        $sale_detail = new SaleDetail();
        $sale_detail->id_sale = $saleId;
        $sale_detail->id_product = $productId;
        $sale_detail->piece = $request-> piece;
        $sale_detail->save();

        return response()->json([
            "message" => "Sale Detail created",
            "sale_detail" => $sale_detail
        ], 201, []);
    }

    //Edit sale_details
    public function edit(Request $request, $sale_detailId){
        $sale_detail = SaleDetail::findOrFail($sale_detailId);
        $sale_detail->piece = $request-> piece;
        $sale_detail->save();

        return response()->json([
            "message" => "Sale Edited",
            "sale_detail" => $sale_detail
        ], 200, []);
    }

    //Get sale_details by ID
    public function show($sale_detailId){
        $sale_detail = SaleDetail::findOrFail($sale_detailId);
        return response()->json([
            "sale_detail" => $sale_detail
        ], 200, []);
    }
}
