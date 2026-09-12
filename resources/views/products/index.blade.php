<!DOCTYPE html>
<html>
<head>
    <title>Product Inventory</title>
</head>
<body>

    <h1>Product Inventory</h1>

    @if(session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    <a href="{{ route('products.create') }}">Add Product</a>

    <br><br>

    <table border="1" cellpadding="8">
        <tr>
            <th>Product Code</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Category</th>
            <th>Action</th>
        </tr>

        @foreach ($products as $product)
            <tr>
                <td>{{ $product->product_code }}</td>
                <td>{{ $product->name }}</td>
                <td>₱{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->category->name }}</td>

                <td>
                    <a href="{{ route('products.edit', $product->id) }}">Edit</a>

                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button 
                            type="submit" onclick="return confirm('Are you sure you want to delete this product?')">Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach

    </table>

</body>
</html>