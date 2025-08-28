@extends('layouts.app')

@section('content')
    <style>
        .register-container {
            max-width: 400px;
            margin: 50px auto;
            background: white;
            padding: 30px 35px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgb(0 0 0 / 0.1);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .register-container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #222;
            font-weight: 700;
            font-size: 1.8rem;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input[type="text"],
        input[type="email"],
        input[type="no_hp"],
        input[type="alamat"],
        input[type="password"] {
            padding: 12px 15px;
            margin-bottom: 18px;
            border: 1.8px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="no_hp"]:focus,
        input[type="alamat"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 6px #007bffaa;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: white;
            font-weight: 700;
            padding: 14px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            background-color: #f8d7da;
            color: #842029;
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .login-link {
            margin-top: 20px;
            text-align: center;
            font-size: 0.95rem;
            color: #444;
        }

        .login-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>

    <div class="register-container">
        <h2>Register</h2>

        @if ($errors->any())
            <div class="error-message">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="text" name="name" placeholder="Nama Lengkap" required value="{{ old('name') }}">
            <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
            <input type="no_hp" name="no_hp" placeholder="No HP" required value="{{ old('no_hp') }}">
            <input type="alamat" name="alamat" placeholder="Alamat" required value="{{ old('alamat') }}">
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
            <button type="submit">Daftar</button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
        </div>
    </div>
@endsection
