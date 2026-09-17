<!DOCTYPE html>
<html>
<head>
    <title>Stock In / Stock Out - Product Inventory</title>
</head>
<body>

    <h1>Stock In / Stock Out</h1>
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('inventory-transactions.store') }}" method="POST">

        @csrf

        <label>Product:</label><br>

        <select name="product_id">
            <option value="">Select Product</option>

            @foreach ($products as $product)
                <option value="{{ $product->id }}">
                    {{ $product->product_code }} - {{ $product->name }}
                </option>
            @endforeach
        </select>

        <br><br>

        <label>Transaction Type:</label><br>

        <select name="type">
            <option value="in">Stock In</option>
            <option value="out">Stock Out</option>
        </select>

        <br><br>

        <label>Quantity:</label><br>
        <input type="number" name="quantity" min="1">

        <br><br>

        <label>Reason / Reference:</label><br>
        <input type="text" name="reason">

        <br><br>

        <button type="submit">Save Transaction</button>

    </form>

    <br>

    <a href="{{ route('products.index') }}">
        Back to Products
    </a>

</body>
</html>