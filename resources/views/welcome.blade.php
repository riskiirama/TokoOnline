<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Butik Fauziah - Selamat Datang</title>
    <style>
        /* Reset & base */
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url({{ asset('images/dash.png') }}) no-repeat center center fixed;
            background-size: cover;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            width: 100%;
            text-align: center;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            padding: 30px;
            backdrop-filter: blur(5px);
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 10px;
            font-weight: 900;
            color: #2563eb;
            letter-spacing: 2px;
        }

        .subtitle {
            font-size: 1.25rem;
            color: #475569;
            margin-bottom: 12px;
            line-height: 1.5;
        }

        .admin-info {
            font-size: 1rem;
            color: #6b7280;
            margin-top: 4px;
            font-weight: 500;
        }

        .admin-info a {
            color: #ef4444;
            font-weight: 700;
            text-decoration: none;
            transition: text-decoration 0.3s ease;
        }

        .admin-info a:hover {
            text-decoration: underline;
        }

        /* Cards container */
        .cards {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 50px;
        }

        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgb(0 0 0 / 0.1);
            padding: 30px 25px;
            flex: 1 1 250px;
            max-width: 280px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            user-select: none;
        }

        .card:hover {
            transform: translateY(-12px);
            box-shadow: 0 16px 40px rgb(37 99 235 / 0.3);
        }

        .card h3 {
            margin-top: 0;
            margin-bottom: 12px;
            color: #1e40af;
            font-weight: 700;
            font-size: 1.4rem;
        }

        .card p {
            color: #475569;
            font-size: 1rem;
            line-height: 1.4;
        }

        /* Buttons */
        .btn-group {
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        a.btn {
            padding: 15px 40px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 1.1rem;
            text-decoration: none;
            transition: background-color 0.3s ease;
            user-select: none;
            min-width: 140px;
        }

        a.btn-login {
            background-color: #3b82f6;
            color: white;
            border: none;
        }

        a.btn-login:hover {
            background-color: #2563eb;
        }

        a.btn-register {
            background-color: #ef4444;
            color: white;
            border: none;
        }

        a.btn-register:hover {
            background-color: #b91c1c;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .cards {
                flex-direction: column;
                gap: 20px;
            }

            .btn-group {
                flex-direction: column;
                gap: 15px;
            }

            a.btn {
                min-width: auto;
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Butik Fauziah</h1>
        <p class="subtitle">Temukan koleksi baju terbaik dengan kualitas premium dan desain elegan.</p>


        <div class="cards">
            <div class="card" tabindex="0" role="button" aria-pressed="false">
                <h3>Kualitas Premium</h3>
                <p>Bahan pilihan terbaik yang nyaman dipakai sehari-hari dan tahan lama.</p>
            </div>
            <div class="card" tabindex="0" role="button" aria-pressed="false">
                <h3>Desain Elegan</h3>
                <p>Model terkini dengan sentuhan klasik untuk penampilan anggun dan modis.</p>
            </div>
            <div class="card" tabindex="0" role="button" aria-pressed="false">
                <h3>Pelayanan Ramah</h3>
                <p>Tim kami siap membantu dan melayani dengan sepenuh hati.</p>
            </div>
            <div class="card" tabindex="0" role="button" aria-pressed="false">
                <h3>Pengiriman Cepat</h3>
                <p>Pesanan dikirim tepat waktu ke alamat tujuan dengan packaging rapi.</p>
            </div>
        </div>

        <div class="btn-group">
            <a href="{{ url('login') }}" class="btn btn-login" role="button">Login</a>
            <a href="{{ url('register') }}" class="btn btn-register" role="button">Register</a>
        </div><br><br>
        <p class="admin-info">
            Apakah kamu <a href="{{ url('/admin/login') }}">admin</a>? Kalau bukan jangan di klik ya<br>
            Jangan Ngeyel ya Sayang!
        </p>
    </div>

</body>

</html>
