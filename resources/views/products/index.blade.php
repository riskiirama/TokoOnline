@extends('layouts.app')

@section('title', 'Daftar Produk')

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

    /* Overlay konten agar teks tetap terbaca */
    .products-container {
        max-width: 900px;
        margin: 40px auto;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #1e293b;
        background: rgba(255, 255, 255, 0.85); /* lapisan transparan */
        backdrop-filter: blur(8px); /* efek blur belakang */
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }
    
    h2 {
        text-align: center;
        color: #2563eb;
        font-weight: 900;
        margin-bottom: 30px;
        font-size: 2.5rem;
    }

    /* Grid produk */
    .products-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 25px;
        justify-content: center;
    }

    /* Kartu produk */
    .product-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgb(0 0 0 / 0.1);
        padding: 20px;
        max-width: 280px;
        flex: 1 1 280px;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: default;
    }
    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 16px 40px rgb(37 99 235 / 0.3);
    }

    .product-img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 15px;
    }

    .product-card h3 {
        color: #1e40af;
        font-weight: 700;
        margin: 0 0 10px 0;
        font-size: 1.4rem;
        text-align: center;
    }

    .product-card p.price {
        font-weight: 700;
        color: #2563eb;
        margin: 0 0 12px 0;
        font-size: 1.1rem;
    }

    .product-card p.description {
        flex-grow: 1;
        color: #475569;
        font-size: 1rem;
        margin-bottom: 20px;
        text-align: center;
    }

    /* Tombol beli */
    .btn-buy {
        display: inline-block;
        background-color: #3b82f6;
        color: white !important;
        padding: 12px 30px;
        border-radius: 30px;
        font-weight: 700;
        font-size: 1.1rem;
        text-decoration: none;
        user-select: none;
        transition: background-color 0.3s ease;
        text-align: center;
        width: 100%;
    }
    .btn-buy:hover {
        background-color: #2563eb;
    }

    /* Link kembali */
    .back-link {
        display: block;
        max-width: 900px;
        margin: 30px auto 0 auto;
        text-align: center;
        color: #475569;
        font-weight: 600;
        text-decoration: none;
        font-size: 1rem;
        transition: color 0.3s ease;
    }
    .back-link:hover {
        color: #2563eb;
        text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 600px) {
        .products-grid {
            flex-direction: column;
            gap: 20px;
        }
        .product-card {
            max-width: 100%;
            height: auto;
        }
    }
</style>

<div class="products-container">
    <h2>Daftar Produk</h2>

    @if($products->count())
        <div class="products-grid">
            @foreach($products as $product)
                <div class="product-card">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-img">
                    <h3>{{ $product->name }}</h3>
                    <p class="price">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="description">{{ $product->description }}</p>
                    <a href="{{ route('products.buy', $product->id) }}" class="btn-buy">Beli</a>
                </div>
            @endforeach
        </div>
    @else
        <p style="text-align: center; color: #6b7280;">Tidak ada produk tersedia.</p>
    @endif

    <a href="{{ url('/home') }}" class="back-link">← Kembali ke Beranda</a>
</div>
@endsection
