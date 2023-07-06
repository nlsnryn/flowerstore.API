<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|max:255|string',
            'product_description' => 'required|max:255|string',
            'quantity' => 'required|max:255',
            'price' => 'required|max:255',
        ]);

        $products = Product::create([
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'status' => true
        ]);

        return response()->json($products);
    }

    public function show(Product $product)
    {
        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {

        $request->validate([
            'product_name' => 'required|max:255|string',
            'product_description' => 'required|max:255|string',
            'quantity' => 'required|max:255',
            'price' => 'required|max:255',
        ]);

        $status = $request->quantity == 0 ? false : true;

        $product->update([
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'status' => $status
        ]);

        return response()->json([
            'message' => 'Update Successfully',
            'product' => $product
        ]);
    }
}
