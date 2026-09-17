<!DOCTYPE html>
<html>
<head>
    <title>Categories - Product Inventory</title>
</head>
<body>

    <h1>Category Management</h1>

    @if(session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    <a href="{{ route('categories.create') }}">Add Category</a>

    <br><br>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Code</th>
            <th>Action</th>
        </tr>

        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->code }}</td>

                <td>
                    <a href="{{ route('categories.edit', $category->id) }}">
                        Edit
                    </a>

                    <form
                        action="{{ route('categories.destroy', $category->id) }}"
                        method="POST"
                        style="display:inline;"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            onclick="return confirm('Are you sure you want to delete this category?')"
                        >
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach

    </table>

</body>
</html>