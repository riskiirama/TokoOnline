<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function create($id)
    {
        $product = Product::findOrFail($id);
        $user = Auth::user();
        return view('transactions.create', compact('product','user'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'ukuran' => 'required|in:S,M,L,XL',
            'qty' => 'required|integer|min:1',
            'bukti_dp' => 'required|image|max:2048',
        ]);

        $product = Product::findOrFail($id);

          if ($product->stock < $request->qty) {
        return back()->with('error', 'Stok produk tidak mencukupi.');
        }

        DB::beginTransaction();

        try {
            $buktiPath = $request->file('bukti_dp')->store('bukti_dp', 'public');
           $subtotal = $product->price * $request->qty;
            $total_dp = $total * 0.5;

            $transaksi = Transaction::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'status' => 'pending',
                'total' => $total,
                // 'alamat_pengiriman' => $request->alamat_pengiriman,
                'bukti_dp' => $buktiPath,
                'total_dp' => $total_dp,
            ]);

            TransactionDetail::create([
                'transaction_id' => $transaksi->id,
                'product_id' => $product->id,
                'qty' => $request->qty,
                'price' => $product->price,
                'subtotal' => $product->price,
                'ukuran_baju' => $request->ukuran,
            ]);

            // ⬇️ Kurangi stok
             $product->decrement('stock', $request->qty);

            DB::commit();
            return redirect('/home')->with('success', 'Transaksi berhasil dikirim, menunggu konfirmasi admin.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function index()
    {
        $transaksis = Transaction::with('details.product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('transactions.index', compact('transaksis'));
    }
}
