<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SSO Dashboard</title>
</head>
<body>
    <h3>Thank you {{ Auth::user()->name }} for login with SSo</h3>
    <a class="btn btn-danger" href="{{ route('logout') }}">Logout</a>
</body>
</html>
