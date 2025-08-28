@extends('layouts.app')

@section('title', 'Form Pembelian - ' . $product->name)

@section('content')
    <style>
        form {
            max-width: 500px;
            background: white;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgb(0 0 0 / 0.1);
            margin: auto;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #333;
        }

        input[type="text"],
        input[type="tel"],
        select,
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 8px 10px;
            margin-bottom: 18px;
            border: 1.5px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.2s ease;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        input[type="tel"]:focus,
        select:focus,
        textarea:focus,
        input[type="file"]:focus {
            border-color: #007bff;
            outline: none;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: white;
            font-weight: 700;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1rem;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-messages {
            background-color: #f8d7da;
            color: #721c24;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .info-text {
            font-size: 1rem;
            margin-bottom: 20px;
            color: #444;
        }

        a.back-link {
            display: inline-block;
            margin-top: 25px;
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
        }

        a.back-link:hover {
            text-decoration: underline;
        }
    </style>

    <h2 style="text-align: center; margin-bottom: 30px;">Form Pembelian - {{ $product->name }}</h2>

    @if ($errors->any())
        <div class="error-messages">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.buy.store', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <p><strong>Rekening Dana untuk pembayaran:</strong> <br>
            <span style="font-weight: 700; color: #007bff;">0812xxxxxxx (Butik Fauziah)</span>
        </p>

        <label for="name">Nama Penerima:</label>
        <input type="text" name="name" id="name" required value="{{ old('name', $user->name ?? '') }}">

        <label for="phone">No HP:</label>
        <input type="tel" name="phone" id="phone" required value="{{ old('phone', $user->no_hp ?? '') }}">

        <label for="address">Alamat Lengkap</label>
        <textarea name="address" id="address" required>{{ old('address', $user->alamat ?? '') }}</textarea>

        <label for="qty">Jumlah:</label>
        <input type="number" name="qty" id="qty" min="1" max="{{ $product->stock }}" required
            value="{{ old('qty', 1) }}">

        <br>
        <br>


        {{-- <label for="alamat_pengiriman">No Rumah:</label>
    <textarea name="alamat_pengiriman" id="alamat_pengiriman" required>{{ old('alamat_pengiriman') }}</textarea> --}}

        <label for="ukuran">Ukuran Baju:</label>
        <select name="ukuran" id="ukuran" required>
            <option value="" disabled selected>-- Pilih Ukuran --</option>
            <option value="S" {{ old('ukuran') == 'S' ? 'selected' : '' }}>S (P 43 cm x L 32 cm)</option>
            <option value="M" {{ old('ukuran') == 'M' ? 'selected' : '' }}>M (P 45 cm x L 34 cm)</option>
            <option value="L" {{ old('ukuran') == 'L' ? 'selected' : '' }}>L (P 47 cm x L 36 cm)</option>
            <option value="XL" {{ old('ukuran') == 'XL' ? 'selected' : '' }}>XL (P 49 cm x L 38 cm)</option>
        </select>


        <label for="bukti_dp">Bukti Bayar DP:</label>
        <input type="file" name="bukti_dp" id="bukti_dp" accept="image/*" required>

        <p class="info-text">
            Total Harga: <strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong><br>
            Total DP (50%): <strong>Rp {{ number_format($product->price * 0.5, 0, ',', '.') }}</strong>
        </p>

        <button type="submit">Kirim</button>
    </form>

    <a href="{{ url('/products') }}" class="back-link">← Kembali ke Produk</a>
@endsection
