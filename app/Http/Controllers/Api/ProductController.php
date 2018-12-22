<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['status'])->paginate(2);
        return response()->json($products, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $fillable_fields = $product->getFillable();
        try {
            $product = Product::create($request->only($fillable_fields));
            return response()->json([
                'message' => 'Product created successfully :)',
                'data' => $product
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating the product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $product = Product::with(['status', 'images'])->findOrFail($id);
            return response()->json($product, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error fetchig the product'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        try {
            $updatedProduct = new Product();
            $product->update($request->only($updatedProduct->getFillable()));
            return response()->json([
                'message' => 'Product updated successfully',
                'data' => $product
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error updating the product'
            ], 500);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return response()->json([
                'message' => 'Product removed successfully :)',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error removing the product'
            ], 500);
        }
    }
}
