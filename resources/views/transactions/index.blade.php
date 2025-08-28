@extends('layouts.app')

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

        .container {
            max-width: 900px;
            margin: 40px auto;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #1e293b;
            background: rgba(255, 255, 255, 0.85);
            /* lapisan putih transparan */
            backdrop-filter: blur(8px);
            /* efek blur */
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        h2 {
            color: #2563eb;
            font-weight: 900;
            font-size: 2.25rem;
            margin: 0;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            user-select: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            color: white;
        }

        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgb(0 0 0 / 0.1);
            padding: 25px 30px;
            margin-bottom: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: default;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 40px rgb(37 99 235 / 0.25);
        }

        .card-title {
            font-weight: 700;
            font-size: 1.4rem;
            margin-bottom: 15px;
            color: #1e40af;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card p {
            margin: 8px 0;
            color: #475569;
            font-size: 1rem;
            line-height: 1.4;
        }

        .card strong {
            color: #222;
        }

        .detail-list {
            list-style-type: disc;
            padding-left: 20px;
            margin-top: 10px;
            margin-bottom: 18px;
            color: #444;
        }

        .detail-list li {
            margin-bottom: 8px;
            font-size: 1rem;
        }

        .bukti-img {
            width: 200px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgb(0 0 0 / 0.12);
            margin-top: 12px;
            display: block;
        }

        /* Status badge */
        .status {
            padding: 6px 16px;
            border-radius: 25px;
            color: white;
            font-weight: 700;
            font-size: 1rem;
            text-transform: capitalize;
            min-width: 110px;
            text-align: center;
            user-select: none;
        }

        .status.pending {
            background-color: #fbbf24;
            /* kuning */
            color: #1f2937;
        }

        .status.paid {
            background-color: #3b82f6;
            /* biru */
        }

        .status.shipped {
            background-color: #14b8a6;
            /* hijau tosca */
        }

        .status.completed {
            background-color: #15803d;
            /* hijau tua */
        }

        .status.canceled {
            background-color: #dc2626;
            /* merah */
        }

        .alert-info {
            background: #e0f2fe;
            color: #0369a1;
            padding: 18px 25px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1.1rem;
            text-align: center;
            user-select: none;
        }
    </style>

    <div class="container">
        <div class="header-section">
            <h2>Riwayat Transaksi Saya</h2>
            <a href="{{ url('/home') }}" class="btn-secondary">Kembali ke Home</a>
        </div>

        @forelse ($transaksis as $transaksi)
            <div class="card">
                <h5 class="card-title">
                    <span>Transaksi</span>
                    <span class="status {{ $transaksi->status }}">{{ ucfirst($transaksi->status) }}</span>
                </h5>
                <p><strong>Rekening Dana untuk pembayaran:</strong><br>
                    <span style="font-weight: 700; color: #3b82f6;">085137961190 (Fauziah)</span>
                </p>

                <p><strong>Total:</strong> Rp{{ number_format($transaksi->total, 0, ',', '.') }}</p>
                <p><strong>Total DP:</strong> Rp{{ number_format($transaksi->total_dp, 0, ',', '.') }}</p>
                <p><strong>Nama Penerima:</strong> {{ $transaksi->name }}</p>
                <p><strong>No HP:</strong> {{ $transaksi->phone }}</p>
                <p><strong>Alamat Pengirim:</strong> {{ $transaksi->address }}</p>
                <p><strong>Alamat Pengiriman:</strong> {{ $transaksi->alamat_pengiriman }}</p>

                <h6>Detail Produk:</h6>
                <ul class="detail-list">
                    @foreach ($transaksi->details as $detail)
                        <li>
                            {{ $detail->product->name }}
                            (Ukuran: {{ $detail->ukuran_baju ?? '-' }},
                            Qty: {{ $detail->qty ?? 1 }},
                            Harga: Rp{{ number_format($detail->price ?? 0, 0, ',', '.') }})
                        </li>
                    @endforeach
                </ul>

                @if ($transaksi->bukti_dp)
                    <p><strong>Bukti DP:</strong></p>
                    <img src="{{ asset('storage/' . $transaksi->bukti_dp) }}" alt="Bukti DP" class="bukti-img">
                @endif
            </div>
        @empty
            <div class="alert-info">Belum ada transaksi.</div>
        @endforelse
    </div>
@endsection
