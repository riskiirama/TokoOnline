<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Hanya ambil produk yang stoknya lebih dari 0
        $products = Product::where('stock', '>', 0)->get();
        return view('products.index', compact('products'));
    }
}
