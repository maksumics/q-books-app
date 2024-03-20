<!-- <h1>Login page</h1>
<form method="POST" action="login">
    @csrf
    <div>
        <input name="email" type="email" placeholder="enter your email" />
    </div>
    <div>
        <input name="password" type="password" placeholder="enter you password" />
    </div>
    <div>
        <input type="submit" value="Log in" />
    </div>
</form> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<div class="login-container">
    <form action="{{ route('login') }}" method="post" class="login-form">
        @csrf
        <h2>Login</h2>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn">Login</button>
    </form>
</div>

</body>
</html>