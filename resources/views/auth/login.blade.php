<!DOCTYPE html>
<html>
<head>
    <title>Login - Product Inventory</title>
</head>
<body>

    <h1>Product Inventory System</h1>

    <h2>Login</h2>

    <form action="{{ url('/login') }}" method="POST">

        @csrf

        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}">

        @error('email')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <br>

        <label>Password:</label><br>
        <input type="password" name="password">

        @error('password')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <br>

        <button type="submit">Login</button>

    </form>

</body>
</html>