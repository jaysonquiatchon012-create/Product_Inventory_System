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

    public function index(Request $request)
    {
        $search = $request->search;
        $type = $request->type;

        $transactions = InventoryTransaction::with(['product', 'user'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('product', function ($productQuery) use ($search) {
                    $productQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('product_code', 'like', "%{$search}%");
                });
            })

            ->when($type, function ($query) use ($type) {
                $query->where('type', $type);
            })
            ->latest('transaction_date')
            ->paginate(10)
            ->withQueryString();

        return view('inventory_transactions.index', compact(
            'transactions',
            'search',
            'type'
        ));
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

        $stockBefore = $product->quantity;

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

        $stockAfter = $product->quantity;

        InventoryTransaction::create([
            'product_id' => $product->id,
            'type' => $request->type,
            'quantity' => $request->quantity,
            'stock_before' => $stockBefore,
            'stock_after' => $stockAfter,
            'reason' => $request->reason,
            'transaction_date' => now(),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Stock transaction saved successfully.');
    }
}