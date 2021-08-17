<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function index(Request $request){
        $bearer = $request->bearerToken();

        $user = DB::table('users')
        ->where('remember_token', $bearer)
        ->first();

        if($user){
            $product_id = $request->input('product_id');
            $quantity = $request->input('quantity');

            $product = DB::table('products')
                ->where('id', $product_id)
                ->first();
            if($product){
                if($product->quantity >= $quantity){
                    DB::table('products')
                        ->where('id' , $product_id)
                        ->update(
                            [
                                'quantity' => $product->quantity - $quantity,
                                'updated_at' => date('Y-m-d h:i:s')
                            ]
                        );
    
                    DB::table('orders')->insert([
                            'product_id' => $product_id,
                            'order_qty' => $quantity,
                            'user_id'   => $user->id,
                            'created_at' => date('Y-m-d h:i:s')
                        ]);
                    return response()->json([
                        'message' => "You have successfully ordered this product.",
                    ], 201);
                }else{
                    return response()->json([
                        'message' => "Failed to order this product due to unavailability of the stock",
                    ], 400);
                }
            }else{
                return response()->json([
                    'message' => "Product doesn't exist.",
                ], 400);
            }
            

        }else{
            return response()->json([
                'message' => "Invalid Token",
            ], 400);
        }
    }
}
