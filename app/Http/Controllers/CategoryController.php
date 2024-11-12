<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
 
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'status' => true,
            'message' => 'Categories retrieved successfully',
            'data' => $categories
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $category = Category::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Category created successfully',
            'data' => $category
        ], 201);
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Category found successfully',
            'data' => $category
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Category updated successfully',
            'data' => $category
        ], 200);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Category deleted successfully'
        ], 204);
    }
}
