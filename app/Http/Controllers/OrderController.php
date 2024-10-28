<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout(OrderRequest $request){
        $totalAmount = 0;
        $products = $request->input('products');
        foreach ($products as $product) {
           $productModel = Product::findOrFail($product['id']);
              $totalAmount += $productModel->price * $product['quantity'];
        }

        $order = Order::create([
            'total_amount' => $totalAmount,
            'user_id' => $request->user()->id,
            'status'=>'pending'
        ]);

        // foreach($products as $product){
        //     $order->products()->attach($product['id'], ['quantity' => $product['quantity']]);
        // }

        return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
    }
}
