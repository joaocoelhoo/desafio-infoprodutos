<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::findOrFail($validatedData['user_id']);
        
        $purchases = $user->purchases()->with('items')->get();

        return response()->json([
            'message' => 'Purchases retrieved successfully',
            'purchases' => $purchases,
        ], 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'items' => 'required|array',
            'items.*' => 'integer|exists:items,id',
        ]);

        $user = User::findOrFail($validatedData['user_id']);

        $purchase = $user->purchases()->create();

        $purchase->items()->attach($validatedData['items']);

        return response()->json([
            'message' => 'Purchase created successfully',
            'purchase' => $purchase->load('items'),
        ], 201);
    }

    public function show($id)
    {
        $purchase = Purchase::with('items')->findOrFail($id);

        return response()->json([
            'message' => 'Purchase found successfully',
            'purchase' => $purchase,
        ], 200);
    }
}