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


        Schema::create('angsurans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pinjaman_id');
            $table->decimal('nominal_angsuran', 15, 2);
            $table->integer('angsuran_ke');
            $table->integer('sisa_angsuran');
            $table->string('jenis_pinjaman');
            $table->date('tanggal_angsuran');
            $table->date('tgl_jatuh_tempo');
            $table->string('status_pembayaran')->default('Belum Lunas');
            $table->decimal('angsuran_perbulan', 15, 2);
            $table->decimal('denda', 15, 2)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('pinjaman_id')->references('id')->on('nasabahs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('angsurans');
    }
};
