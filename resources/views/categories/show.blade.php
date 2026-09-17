<!DOCTYPE html>
<html>
<head>
    <title>View Category - Product Inventory</title>
</head>
<body>

    <h1>Category Details</h1>

    <p>
        <strong>ID:</strong>
        {{ $category->id }}
    </p>

    <p>
        <strong>Category Name:</strong>
        {{ $category->name }}
    </p>

    <p>
        <strong>Category Code:</strong>
        {{ $category->code }}
    </p>

    <br>

    <a href="{{ route('categories.edit', $category->id) }}">
        Edit Category
    </a>

    <br><br>

    <a href="{{ route('categories.index') }}">
        Back to Categories
    </a>

</body>
</html>