<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Toko')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> {{-- opsional --}}
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 0;
            margin: 0;
            background-color: #f9f9f9;
            color: #1e293b;
        }

        nav {
            background: #2563eb;
            box-shadow: 0 3px 8px rgb(0 0 0 / 0.15);
            user-select: none;
        }
        nav div {
            max-width: 900px;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            gap: 30px;
            padding: 14px 0;
        }
        nav a {
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
            text-decoration: none;
            user-select: none;
            transition: color 0.3s ease;
        }
        nav a:hover {
            text-decoration: underline;
            color: #dbeafe;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }

        @media (max-width: 600px) {
            nav div {
                flex-wrap: wrap;
                gap: 15px;
                justify-content: center;
            }
            nav a {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

    @php
        $hideNavbar = request()->routeIs('login') || request()->routeIs('register');
    @endphp

    @if (!$hideNavbar)
        <nav>
            <div>
                <a href="{{ url('/home') }}">Home</a>
                <a href="{{ route('products.index') }}">Produk</a>

                @auth
                    <a href="{{ route('transaksi.index') }}">Transaksiku</a>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        </nav>
    @endif

    <div class="container">
        @yield('content')
    </div>

</body>
</html>
