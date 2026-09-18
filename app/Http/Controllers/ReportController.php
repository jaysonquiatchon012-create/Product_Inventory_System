<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\InventoryTransaction;

class ReportController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();

        $totalStock = Product::sum('quantity');

        $totalStockIn = InventoryTransaction::where('type', 'in')
            ->sum('quantity');

        $totalStockOut = InventoryTransaction::where('type', 'out')
            ->sum('quantity');

        $lowStockProducts = Product::where('quantity', '>', 0)
            ->whereColumn('quantity', '<=', 'minimum_stock')
            ->get();

        return view('reports.index', compact(
            'totalProducts',
            'totalStock',
            'totalStockIn',
            'totalStockOut',
            'lowStockProducts'
        ));
    }
}