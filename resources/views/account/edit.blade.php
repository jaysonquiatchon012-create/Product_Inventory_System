<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile - Product Inventory</title>
</head>
<body>

    <h1>Edit Profile</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('account.update') }}" method="POST">

        @csrf
        @method('PUT')

        <label>Name:</label><br>
        <input
            type="text"
            name="name"
            value="{{ $user->name }}"
        >

        <br><br>

        <label>Email:</label><br>
        <input
            type="email"
            name="email"
            value="{{ $user->email }}"
        >

        <br><br>

        <button type="submit">
            Update Profile
        </button>

    </form>

    <br>

    <a href="{{ route('account.index') }}">
        Back to My Account
    </a>

</body>
</html>