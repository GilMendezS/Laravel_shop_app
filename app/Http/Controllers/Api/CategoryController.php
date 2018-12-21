<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newCategory = new Category();
        try{
            $newCategory = Category::create($request->only($newCategory->getFillable()));
            return response()->json([
                'message' => 'Category created successfully',
                'data' => $newCategory
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'message' => 'Error saving the category'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response()->json($category, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $updatedCategory = new Category();
        try {
            $category->update($request->only($updatedCategory->getFillable()));
            return response()->json([
                'message' => 'Category updated successfully!',
                'data' => $category
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error updating the category.'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return response()->json([
                'message' => 'Category removed successfully!',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error removing the category'
            ], 500);
        }
    }
}
