<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::query();

        if ($request->has('category_id')) {
            $categoryId = $request->input('category_id');
            $query->where('category_id', $categoryId);
        }

        $items = $query->with('category')->get();

        return response()->json([
            'status' => true,
            'message' => 'Items retrieved successfully',
            'data' => $items,
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|decimal:2',
            'category_id' => 'exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $items = Item::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Item created successfully',
            'data' => $items
        ], 201);
    }

    public function show($id)
    {
        $item = Item::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Item found successfully',
            'data' => $item
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|decimal:2',
            'category_id' => 'exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $item = Item::findOrFail($id);
        $item->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Item updated successfully',
            'data' => $item
        ], 200);
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Item deleted successfully'
        ], 204);
    }
}
