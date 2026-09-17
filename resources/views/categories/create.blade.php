<!DOCTYPE html>
<html>
<head>
    <title>Add Category - Product Inventory</title>
</head>
<body>

    <h1>Add Category</h1>

    <form action="{{ route('categories.store') }}" method="POST">

        @csrf

        <label>Category Name:</label><br>
        <input type="text" name="name" value="{{ old('name') }}">

        @error('name')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <br><br>

        <label>Category Code:</label><br>
        <input type="text" name="code" value="{{ old('code') }}">

        @error('code')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <br><br>

        <button type="submit">Save Category</button>

    </form>

    <br>

    <a href="{{ route('categories.index') }}">Back to Categories</a>

</body>
</html>