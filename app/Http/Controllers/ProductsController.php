<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $products = Products::all();
        return response()->json([
            'status' => 'success',
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name'  => 'required|string|max:255',
            'price'         => 'required|max:11',
            'description'   => 'required|string|max:255',
        ]);

        $product = Products::create([
            'product_name'  => $request->product_name,
            'price'         => $request->price,
            'description'   => $request->description,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Product created successfully',
            'product' => $product,
        ]);
    }

    public function show($id)
    {
        $product = Products::find($id);
        return response()->json([
            'status' => 'success',
            'product' => $product,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name'  => 'required|string|max:255',
            'price'         => 'required|numeric|max:11',
            'description'   => 'required|string|max:255',
        ]);

        $products = Products::find($id);
        $products->product_name  = $request->product_name;
        $products->price         = $request->price;
        $products->description   = $request->description;
        $products->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Product updated successfully',
            'product' => $products,
        ]);
    }

    public function destroy($id)
    {
        $products = Products::find($id);
        $products->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Product deleted successfully',
            'product' => $products,
        ]);
    }
}
