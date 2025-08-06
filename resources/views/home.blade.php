@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<style>
    /* Background full halaman */
    body {
        background-image: url("{{ asset('images/dash.png') }}");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        min-height: 100vh;
        margin: 0;
    }

    .home-container {
        width: 100%;
        margin: 0;
        padding: 40px 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #1e293b;
        line-height: 1.6;
    }

    .home-inner {
        max-width: 1200px;
        margin: 0 auto;
        background: rgba(255, 255, 255, 0.85); /* lapisan transparan */
        backdrop-filter: blur(8px); /* efek blur belakang */
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgb(0 0 0 / 0.1);
    }

    .home-container h1 {
        font-size: 2.5rem;
        font-weight: 900;
        margin-bottom: 15px;
        color: #2563eb;
        text-align: center;
    }

    .home-container p.intro {
        font-size: 1.2rem;
        margin-bottom: 30px;
        color: #475569;
        text-align: center;
    }

    .btn-primary {
        display: block;
        max-width: 220px;
        margin: 0 auto 40px auto;
        background-color: #3b82f6;
        color: white !important;
        padding: 14px 40px;
        border-radius: 30px;
        font-weight: 700;
        font-size: 1.1rem;
        text-align: center;
        text-decoration: none;
        transition: background-color 0.3s ease;
        user-select: none;
    }

    .btn-primary:hover {
        background-color: #2563eb;
    }

    .home-image {
        display: block;
        margin: 0 auto 40px auto;
        max-width: 200px;
        width: 100%;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .features {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        width: 100%;
        padding: 0 20px;
        box-sizing: border-box;
    }

    .feature-card {
        background: #f0f9ff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgb(0 0 0 / 0.05);
        padding: 20px 25px;
        flex: 0 1 31%; /* 3 kolom sejajar */
        text-align: center;
        transition: box-shadow 0.3s ease, transform 0.3s ease;
        box-sizing: border-box;
    }

    .feature-card:hover {
        box-shadow: 0 8px 30px rgb(37 99 235 / 0.3);
        transform: translateY(-8px);
    }

    .feature-card h3 {
        margin-top: 0;
        margin-bottom: 12px;
        color: #1e40af;
        font-weight: 700;
        font-size: 1.3rem;
    }

    .feature-card p {
        color: #475569;
        font-size: 1rem;
        line-height: 1.4;
    }

    @media (max-width: 1024px) {
        .feature-card {
            flex: 0 1 48%; /* 2 kolom di tablet */
        }
    }

    @media (max-width: 640px) {
        .feature-card {
            flex: 0 1 100%; /* 1 kolom di HP */
        }
    }
</style>

<div class="home-container">
    <div class="home-inner">
        <div class="features">
            <div><img src="{{ asset('images/butik.png') }}" alt="Gambar Butik" class="home-image"></div>
            <div><img src="{{ asset('images/butik2.png') }}" alt="Gambar Butik" class="home-image"></div>
            <div><img src="{{ asset('images/butik1.png') }}" alt="Gambar Butik" class="home-image"></div>
        </div>

        <h1>Selamat datang, {{ Auth::user()->name }}!</h1>
        <p class="intro">Silakan pilih produk yang ingin dibeli. Berikut beberapa keunggulan Butik Fauziah yang membuat kami pilihan tepat untuk pakaian berkualitas Anda.</p>
        <a href="{{ route('products.index') }}" class="btn-primary">Lihat Produk</a>

        <div class="features">
            <div class="feature-card">
                <h3>Kualitas Terjamin</h3>
                <p>Kami menggunakan bahan berkualitas premium yang nyaman dipakai dan tahan lama, memberikan Anda pengalaman terbaik.</p>
            </div>
            <div class="feature-card">
                <h3>Desain Eksklusif</h3>
                <p>Setiap koleksi dirancang dengan penuh perhatian terhadap detail, memadukan tren modern dan sentuhan klasik.</p>
            </div>
            <div class="feature-card">
                <h3>Layanan Profesional</h3>
                <p>Tim customer service kami siap membantu Anda dengan ramah dan cepat, menjawab setiap pertanyaan dengan solusi tepat.</p>
            </div>
            <div class="feature-card">
                <h3>Pengiriman Cepat & Aman</h3>
                <p>Pesanan Anda akan dikemas dengan rapi dan dikirim tepat waktu ke alamat tujuan, tanpa khawatir kerusakan.</p>
            </div>
            <div class="feature-card">
                <h3>Harga Kompetitif</h3>
                <p>Kami menawarkan produk berkualitas dengan harga yang bersaing agar Anda mendapat nilai terbaik dari setiap pembelian.</p>
            </div>
            <div class="feature-card">
                <h3>Pilihan Lengkap</h3>
                <p>Kami menyediakan berbagai macam model dan ukuran baju yang cocok untuk berbagai gaya dan kebutuhan Anda.</p>
            </div>
        </div>
    </div>
</div>
@endsection
