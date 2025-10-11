<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('laporans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pengaduan_id')->constrained('pengaduans')->onDelete('cascade');
        $table->foreignId('teknisi_id')->nullable()->constrained('teknisis')->onDelete('set null');
        $table->date('tanggal_perbaikan')->nullable();
        $table->text('hasil_perbaikan')->nullable();
        $table->timestamps();
    });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
