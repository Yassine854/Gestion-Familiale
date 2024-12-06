<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel App</title>
    <!-- Add your CSS and JavaScript links here -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<style>
    body {
        background-color: #B7C9E2 /* Light Blue */
    }
</style>
</head>
<body class="mx-5 mt-2">
    <header>
        <nav >
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('register') }}">Register</a>
                        </li>
                    @else
                    <li class="nav-item">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link">Logout</button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
    </header>

    <div class="container mt-4">
        @yield('content')
    </div>

    <footer class="text-center py-3">
        &copy; {{ date('Y') }} Smart Conseil
    </footer>

    <!-- Add your JavaScript scripts here -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
