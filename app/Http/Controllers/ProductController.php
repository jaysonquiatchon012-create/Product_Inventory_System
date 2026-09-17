<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $category = $request->category;

        $products = Product::with('category')
            ->when($search, function ($query) use ($search) {
                $query->where('product_code', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%");
            })
            ->when($category, function ($query) use ($category) {
                $query->where('category_id', $category);
            })
            ->paginate(5);

        $categories = \App\Models\Category::all();

        // Stock Status
        $products->each(function ($product) {
            if ($product->quantity == 0) {
                $product->stockStatus = 'Out of Stock';
            } elseif ($product->quantity <= $product->minimum_stock) {
                $product->stockStatus = 'Low Stock';
            } else {
                $product->stockStatus = 'In Stock';
            }
        });

        // Dashboard Statistics
        $totalProducts = Product::count();
        $totalCategories = \App\Models\Category::count();
        $totalStock = Product::sum('quantity');

        $lowStockProducts = Product::where('quantity', '>', 0)
            ->whereColumn('quantity', '<=', 'minimum_stock')
            ->get();

        return view('products.index', compact(
            'products',
            'search',
            'categories',
            'category',
            'totalProducts',
            'totalCategories',
            'totalStock',
            'lowStockProducts'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = \App\Models\Category::all();
        $suppliers = \App\Models\Supplier::all();

        return view('products.create', compact('categories', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_code' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'minimum_stock' => 'required|integer',
            'category_id' => 'required',
            'supplier_id' => 'required',
        ]);

        $product = Product::create([
            'product_code' => $request->product_code,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'minimum_stock' => $request->minimum_stock,
            'category_id' => $request->category_id,
        ]);

        $product->suppliers()->attach($request->supplier_id);

        return redirect()->route('products.index')
            ->with('success', 'Product added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with(['category', 'suppliers'])->findOrFail($id);

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = \App\Models\Category::all();
        $suppliers = \App\Models\Supplier::all();

        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
             'product_code' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'minimum_stock' => 'required|integer',
            'category_id' => 'required',
            'supplier_id' => 'required',
        ]);

        $product->update([
            'product_code' => $request->product_code,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'minimum_stock' => $request->minimum_stock,
            'category_id' => $request->category_id,
        ]);

        $product->suppliers()->sync([$request->supplier_id]);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}