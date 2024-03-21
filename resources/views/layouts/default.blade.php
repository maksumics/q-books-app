<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <header>
        <h1>Q - Books - App</h1>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                @checkAuth
                <li><a href="{{ route('authors-list') }}">Authors</a></li>
                <li><a href="{{ route('book-create') }}">New book</a></li>
                <li style="float:right;"><a href="{{ route('logout') }}">Log out</a></li>
                <li style="float:right;">Welcome, {{ session('username') }}</li>
                @else
                <li style="float:right;"><a href="{{ route('login') }}">Log in</a></li>
                @endcheckAuth

            </ul>
        </nav>
    </header>
    
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer>
        <p>Q - Books - Senaid @ 2024</p>
    </footer>
</body>
</html>