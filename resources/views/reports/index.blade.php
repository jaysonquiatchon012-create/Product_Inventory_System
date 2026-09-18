<!DOCTYPE html>
<html>
<head>
    <title>Inventory Reports</title>
</head>
<body>

    <h1>Inventory Reports</h1>

    <h2>Inventory Summary</h2>

    <p>
        <strong>Total Products:</strong>
        {{ $totalProducts }}
    </p>

    <p>
        <strong>Total Stock:</strong>
        {{ $totalStock }}
    </p>

    <p>
        <strong>Total Stock In:</strong>
        {{ $totalStockIn }}
    </p>

    <p>
        <strong>Total Stock Out:</strong>
        {{ $totalStockOut }}
    </p>

    <h2>Low Stock Products</h2>

    @if ($lowStockProducts->count() > 0)

        <ul>
            @foreach ($lowStockProducts as $product)
                <li>
                    {{ $product->product_code }}
                    -
                    {{ $product->name }}
                    | Stock: {{ $product->quantity }}
                    | Minimum: {{ $product->minimum_stock }}
                </li>
            @endforeach
        </ul>

    @else

        <p>No low stock products.</p>

    @endif

    <br>

    <a href="{{ route('products.index') }}">
        Back to Products
    </a>

</body>
</html>