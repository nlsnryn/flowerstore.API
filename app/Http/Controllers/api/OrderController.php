<?php

namespace App\Http\Controllers\api;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function order(Request $request)
    {
        $order = Order::create([
            'product_id' => $request->product_id,
            'user_id' => $request->user_id,
            'price' => $request->price * $request->quantity
        ]);

        $this->updateQuantity($request);

        return response()->json([
            'message' => 'Order successfully',
            'order_data' => $order
        ]);
    }

    public function viewOrders()
    {
        $id = Auth::id();
        $orders = Order::where('user_id', $id)->get();

        $orderData = [];

        foreach ($orders as $order) {
            $products = Product::where('id', $order->product_id)->get();

            foreach ($products as $product) {
                $orderData[] = [
                    'order_id' => $order->id,
                    'product_name' => $product->product_name,
                    'product_price' => $product->price,
                    'order_price' => $order->price
                ];
            }
        }

        return response()->json([
            'message' => 'fetched successfully',
            'data' => $orderData
        ]);
    }

    public function updateQuantity($request)
    {
        $product = Product::where('id', $request->product_id)->first();
        // dd($product);
        $newQuantity = $product->quantity - $request->quantity;

        $product->update([
            'quantity' => $newQuantity
        ]);

        return;
    }
}
