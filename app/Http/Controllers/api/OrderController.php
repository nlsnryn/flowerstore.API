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
        $quantityUpdated = $this->updateQuantity($request);
        if ($quantityUpdated) {
            return $quantityUpdated;
        }

        $order = Order::create([
            'product_id' => $request->product_id,
            'user_id' => $request->user_id,
            'price' => $request->price * $request->quantity
        ]);

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

        if ($product->quantity >= $request->quantity && !!$request->quantity) {
            $newQuantity = $product->quantity - $request->quantity;

            $product->update([
                'quantity' => $newQuantity
            ]);
        } else {
            return response()->json([
                'message' => 'Its either falsy value or out of stocks, check the product quantity.'
            ]);
        }
    }
}
