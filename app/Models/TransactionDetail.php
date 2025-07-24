<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'product_id',
        'qty',
        'price',
        'subtotal',
        'ukuran_baju',
    ];

    protected static function booted()
    {
        static::creating(function ($detail) {
            $detail->subtotal = $detail->qty * $detail->price;
        });

        static::updating(function ($detail) {
            $detail->subtotal = $detail->qty * $detail->price;
        });

        static::saved(function ($detail) {
            optional(Transaction::find($detail->transaction_id))->updateTotal();

        });

        static::deleted(function ($detail) {
            optional(Transaction::find($detail->transaction_id))->updateTotal();

        });
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
