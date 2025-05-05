<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class InventoryController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('inventory', compact('products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'stock' => 'required|integer|min:0'
        ]);

        $product = Product::findOrFail($id);
        $product->stock = $request->stock;
        $product->save();

        return back()->with('success', 'Stock updated successfully.');
    }
}
