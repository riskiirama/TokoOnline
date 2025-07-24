<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'address',
        'status',
        'total',
        'alamat_pengiriman',
        'bukti_dp',
        'total_dp',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke detail transaksi
     */
    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    /**
     * Menghitung ulang total dari semua subtotal detail
     */
    public function updateTotal(): void
{
    $this->total = $this->details()->sum('subtotal');
    $this->total_dp = $this->total * 0.5; // otomatis 50% dari total
    $this->save();
}

}
