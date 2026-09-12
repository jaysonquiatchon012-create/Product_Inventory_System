<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>

    <h1>Add Product</h1>

        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <label>Product Code:</label><br>
        <input type="text" name="product_code"><br><br>

        <label>Product Name:</label><br>
        <input type="text" name="name"><br><br>

        <label>Description:</label><br>
        <textarea name="description"></textarea><br><br>

        <label>Price:</label><br>
        <input type="number" name="price" step="0.01"><br><br>

        <label>Quantity:</label><br>
        <input type="number" name="quantity"><br><br>

        <label>Category:</label><br>
        <select name="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <br><br>

        <button type="submit">Save Product</button>
    </form>

    <br>

    <a href="{{ route('products.index') }}">Back to Products</a>

</body>
</html>