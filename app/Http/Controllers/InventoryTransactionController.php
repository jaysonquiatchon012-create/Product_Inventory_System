<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\InventoryTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InventoryTransactionController extends Controller
{
    public function create()
    {
        $products = Product::all();

        return view('inventory_transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'reason' => 'nullable|string|max:255',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->type === 'out' && $request->quantity > $product->quantity) {
            return back()
                ->withErrors([
                    'quantity' => 'Stock Out quantity cannot be greater than current stock.',
                ])
                ->withInput();
        }

        if ($request->type === 'in') {
            $product->quantity += $request->quantity;
        } else {
            $product->quantity -= $request->quantity;
        }

        $product->save();

        InventoryTransaction::create([
            'product_id' => $product->id,
            'type' => $request->type,
            'quantity' => $request->quantity,
            'reason' => $request->reason,
            'transaction_date' => now(),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Stock transaction saved successfully.');
    }
}