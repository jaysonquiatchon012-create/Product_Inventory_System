<!DOCTYPE html>
<html>
<head>
    <title>My Account - Product Inventory</title>
</head>
<body>

    <h1>My Account</h1>

    <h2>Account Information</h2>

    <p>
        <strong>Name:</strong>
        {{ $user->name }}
    </p>

    <p>
        <strong>Email:</strong>
        {{ $user->email }}
    </p>

    <br>

    @if(session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    <a href="{{ route('account.edit') }}">
        Edit Profile
    </a>

    <br><br>

    <a href="{{ route('account.password') }}">
        Change Password
    </a>

    <br><br>

    <a href="{{ route('products.index') }}">
        Back to Products
    </a>

</body>
</html>