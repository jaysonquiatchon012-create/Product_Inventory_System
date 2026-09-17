<!DOCTYPE html>
<html>
<head>
    <title>View Supplier - Product Inventory</title>
</head>
<body>

    <h1>Supplier Details</h1>

    <p>
        <strong>ID:</strong>
        {{ $supplier->id }}
    </p>

    <p>
        <strong>Supplier Code:</strong>
        {{ $supplier->code }}
    </p>

    <p>
        <strong>Supplier Name:</strong>
        {{ $supplier->name }}
    </p>

    <p>
        <strong>Contact:</strong>
        {{ $supplier->contact }}
    </p>

    <br>

    <a href="{{ route('suppliers.edit', $supplier->id) }}">
        Edit Supplier
    </a>

    <br><br>

    <a href="{{ route('suppliers.index') }}">
        Back to Suppliers
    </a>

</body>
</html>