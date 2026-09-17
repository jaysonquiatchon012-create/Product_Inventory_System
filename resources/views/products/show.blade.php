<!DOCTYPE html>
<html>
<head>
    <title>View Product</title>
</head>
<body>

    <h1>Product Details</h1>

    <p>
        <strong>Product Code:</strong>
        {{ $product->product_code }}
    </p>

    <p>
        <strong>Product Name:</strong>
        {{ $product->name }}
    </p>

    <p>
        <strong>Description:</strong>
        {{ $product->description }}
    </p>

    <p>
        <strong>Price:</strong>
        ₱{{ $product->price }}
    </p>

    <p>
        <strong>Quantity:</strong>
            {{ $product->quantity }}
        </p>

        <p>
            <strong>Stock Status:</strong>

            @if ($product->quantity == 0)
                Out of Stock
            @elseif ($product->quantity <= $product->minimum_stock)
                Low Stock
            @else
                In Stock
            @endif
    </p>

    <p>
        <strong>Category:</strong>
        {{ $product->category->name }}
    </p>

    <p>
        <strong>Supplier:</strong>

        @foreach ($product->suppliers as $supplier)
            {{ $supplier->name }}
        @endforeach
    </p>

    <br>

    <a href="{{ route('products.edit', $product->id) }}">
        Edit Product
    </a>

    <br><br>

    <a href="{{ route('products.index') }}">
        Back to Products
    </a>

</body>
</html>