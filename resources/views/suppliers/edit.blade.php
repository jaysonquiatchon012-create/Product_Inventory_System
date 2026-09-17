<!DOCTYPE html>
<html>
<head>
    <title>Edit Supplier - Product Inventory</title>
</head>
<body>

    <h1>Edit Supplier</h1>

    <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">

        @csrf
        @method('PUT')

        <label>Supplier Code:</label><br>
        <input
            type="text"
            name="code"
            value="{{ old('code', $supplier->code) }}"
        >

        @error('code')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <br><br>

        <label>Supplier Name:</label><br>
        <input
            type="text"
            name="name"
            value="{{ old('name', $supplier->name) }}"
        >

        @error('name')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <br><br>

        <label>Contact:</label><br>
        <input
            type="text"
            name="contact"
            value="{{ old('contact', $supplier->contact) }}"
        >

        @error('contact')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <br><br>

        <button type="submit">Update Supplier</button>

    </form>

    <br>

    <a href="{{ route('suppliers.index') }}">
        Back to Suppliers
    </a>

</body>
</html>