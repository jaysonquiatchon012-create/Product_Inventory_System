<!DOCTYPE html>
<html>
<head>
    <title>Change Password - Product Inventory</title>
</head>
<body>

    <h1>Change Password</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('account.update-password') }}" method="POST">

        @csrf
        @method('PUT')

        <label>Current Password:</label><br>
        <input type="password" name="current_password">

        <br><br>

        <label>New Password:</label><br>
        <input type="password" name="password">

        <br><br>

        <label>Confirm New Password:</label><br>
        <input type="password" name="password_confirmation">

        <br><br>

        <button type="submit">
            Change Password
        </button>

    </form>

    <br>

    <a href="{{ route('account.index') }}">
        Back to My Account
    </a>

</body>
</html>