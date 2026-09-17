<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>

    <h1>Edit Product</h1>

        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Product Code:</label><br>
        <input type="text" name="product_code" value="{{ $product->product_code }}"><br><br>

        <label>Product Name:</label><br>
        <input type="text" name="name" value="{{ $product->name }}"><br><br>

        <label>Description:</label><br>
        <textarea name="description">{{ $product->description }}</textarea><br><br>

        <label>Price:</label><br>
        <input type="number" name="price" step="0.01" value="{{ $product->price }}"><br><br>

        <label>Quantity:</label><br>
        <input type="number" name="quantity" value="{{ $product->quantity }}"><br><br>

        <label>Minimum Stock Level:</label><br>
        <input
            type="number"
            name="minimum_stock"
            value="{{ $product->minimum_stock }}"
        ><br><br>

        <label>Category:</label><br>
        <select name="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <br><br>

        <label>Supplier:</label><br>
        <select name="supplier_id">
            <option value="">Select Supplier</option>

            @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}"
                    {{ $product->suppliers->contains($supplier->id) ? 'selected' : '' }}>
                    {{ $supplier->name }}
                </option>
            @endforeach
        </select>

        <br><br>

        <button type="submit">Update Product</button>
    </form>

    <br>

    <a href="{{ route('products.index') }}">Back to Products</a>

</body>
</html>