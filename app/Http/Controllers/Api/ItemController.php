<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::get();
        if($items->count() > 0)
            {
                return ItemResource::collection($items);
            }
            else
            {
                return response()->json(['message' => 'No items available'], 200);
            }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'color' => 'nullable|string',
            ]);

            $product = Item::create([
                'name' => $request->name,
                'description' => $request->description,
                'color' => $request->color,
            ]);

            return response()->json([
                'message'=> 'Item created successfully',
                'data' => new ItemResource($product)
                ],200);
    }

    public function show(Item $item)
    {
        return new ItemResource($item);
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'color' => 'nullable|string',
        ]);

        $item->update($request->all());

        return response()->json([
            'message'=> 'Item updated successfully',
            'data' => new ItemResource($item)
            ],200);
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Item deleted successfully'], 200);
    }

}
