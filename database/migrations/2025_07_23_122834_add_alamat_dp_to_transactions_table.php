<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // $table->text('alamat_pengiriman')->nullable();
            $table->string('bukti_dp')->nullable();
            $table->decimal('total_dp', 12, 2)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['bukti_dp', 'total_dp']);
        });
    }
};
