<!DOCTYPE html>
<html>
<head>
    <title>Suppliers - Product Inventory</title>
</head>
<body>

    <h1>Supplier Management</h1>

    @if(session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    <a href="{{ route('suppliers.create') }}">Add Supplier</a>

    <br><br>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Supplier Code</th>
            <th>Supplier Name</th>
            <th>Contact</th>
            <th>Action</th>
        </tr>

        @foreach ($suppliers as $supplier)
            <tr>
                <td>{{ $supplier->id }}</td>
                <td>{{ $supplier->code }}</td>
                <td>{{ $supplier->name }}</td>
                <td>{{ $supplier->contact }}</td>

                <td>
                    <a href="{{ route('suppliers.edit', $supplier->id) }}">
                        Edit
                    </a>

                    <form
                        action="{{ route('suppliers.destroy', $supplier->id) }}"
                        method="POST"
                        style="display:inline;"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            onclick="return confirm('Are you sure you want to delete this supplier?')"
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