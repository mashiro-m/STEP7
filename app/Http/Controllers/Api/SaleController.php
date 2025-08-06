<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{


    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            // quantity は無しでOK
        ]);
    
        DB::beginTransaction();
    
        try {
            $product = Product::find($request->product_id);
    
            if ($product->stock < 1) { // 1個購入前提
                return response()->json([
                    'message' => '在庫が不足しています。'
                ], 400);
            }
    
            // 購入処理：quantity なし
            $sale = Sale::create([
                'product_id' => $product->id,
                // 'quantity' => 1, // なし
            ]);
    
            // 在庫を1減らす
            $product->stock -= 1;
            $product->save();
    
            DB::commit();
    
            return response()->json([
                'message' => '購入処理が完了しました。',
                'sale' => $sale
            ], 201);
    
        } catch (\Exception $e) {
            DB::rollBack();
    
            return response()->json([
                'message' => '購入処理中にエラーが発生しました。',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
    
}
