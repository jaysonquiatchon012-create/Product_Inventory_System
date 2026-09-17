<!DOCTYPE html>
<html>
<head>
    <title>Add Supplier - Product Inventory</title>
</head>
<body>

    <h1>Add Supplier</h1>

    <form action="{{ route('suppliers.store') }}" method="POST">

        @csrf

        <label>Supplier Code:</label><br>
        <input type="text" name="code" value="{{ old('code') }}">

        @error('code')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <br><br>

        <label>Supplier Name:</label><br>
        <input type="text" name="name" value="{{ old('name') }}">

        @error('name')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <br><br>

        <label>Contact:</label><br>
        <input type="text" name="contact" value="{{ old('contact') }}">

        @error('contact')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <br><br>

        <button type="submit">Save Supplier</button>

    </form>

    <br>

    <a href="{{ route('suppliers.index') }}">
        Back to Suppliers
    </a>

</body>
</html>