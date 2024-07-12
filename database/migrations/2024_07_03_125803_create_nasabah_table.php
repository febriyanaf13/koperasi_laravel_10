<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nasabahs', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('nik')->unique();
//            $table->foreignId('transaksi_id')->nullable()->constrained('transaksis');
            $table->string('name');
            $table->string('jenis_pinjaman');
            $table->float('besar_pinjaman');
            $table->float('bunga');
            $table->string('tipe_bunga');
            $table->float('bunga_perbulan');
            $table->float('total_bunga_harus_dibayar');
            $table->string('lama_angsuran');
            $table->string('sisa_angsuran');
            $table->string('angsuran_perbulan');
            $table->string('status_angsuran');
            $table->date('tanggal_pinjaman');
            $table->date('tanggal_jatuh_tempo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nasabahs');
    }
};
