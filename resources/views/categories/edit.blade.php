<!DOCTYPE html>
<html>
<head>
    <title>Edit Category - Product Inventory</title>
</head>
<body>

    <h1>Edit Category</h1>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">

        @csrf
        @method('PUT')

        <label>Category Name:</label><br>
        <input
            type="text"
            name="name"
            value="{{ old('name', $category->name) }}"
        >

        @error('name')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <br><br>

        <label>Category Code:</label><br>
        <input
            type="text"
            name="code"
            value="{{ old('code', $category->code) }}"
        >

        @error('code')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <br><br>

        <button type="submit">Update Category</button>

    </form>

    <br>

    <a href="{{ route('categories.index') }}">
        Back to Categories
    </a>

</body>
</html>