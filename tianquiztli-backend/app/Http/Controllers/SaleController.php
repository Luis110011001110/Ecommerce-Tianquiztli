<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Sale;

class SaleController extends Controller
{
      //Get all sales and search sales by params
      public function index($userId, $artisanId, $text=null){
        $sales = DB::table('sales')
                        ->join('users','users.id', '=', 'sales.id_user')
                        ->join('artisans','artisans.id', '=', 'sales.id_artisan')
                        ->where(function ($query) use ($userId) {
                            if($userId != -1){
                               $query->where('users.id', '=', $userId);
                            }
                        })
                        ->where(function ($query) use ($artisanId) {
                            if($artisanId != -1){
                               $query->where('artisans.id', '=', $artisanId);
                            }
                        })
                        ->where(function ($query) use($text) {
                            if($text != null){
                                $query->where('sales.send_status', 'like', '%'. $text .'%')
                                ->orWhere('sales.pay_status', 'like', '%'. $text .'%');
                            }
                        })->select('sales.*','artisans.*')->get();

        return response()->json([
            "sales" => $sales
        ], 200, []);
    }

    

    //Create sale
    public function store(Request $request, $userId, $artisanId){
        $sale = new Sale();
        $sale->id_artisan = $artisanId;
        $sale->id_user = $userId;
        $sale->total = $request-> total;
        $sale->send_status = $request-> send_status;
        $sale->pay_status = $request-> pay_status;
        $sale->save();

        return response()->json([
            "message" => "Sale created",
            "sale" => $sale
        ], 201, []);
    }

    //Edit sale
    public function edit(Request $request, $saleId){
        $sale = Sale::findOrFail($saleId);
        $sale->total = $request-> total;
        $sale->send_status = $request-> send_status;
        $sale->pay_status = $request-> pay_status;
        $sale->save();

        return response()->json([
            "message" => "Sale Edited",
            "sale" => $sale
        ], 200, []);
    }

    //Get sale by ID
    public function show($saleId){
        $sale = Sale::findOrFail($saleId);

        return response()->json([
            "sale" => $sale
        ], 200, []);
    }
}
