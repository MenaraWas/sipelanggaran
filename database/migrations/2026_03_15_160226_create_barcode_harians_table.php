<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barcode_harians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_pelanggaran_id')->constrained()->cascadeOnDelete();
            $table->date('tanggal');
            $table->string('token', 64)->unique();
            $table->integer('nilai_default')->nullable();
            $table->foreignId('dibuat_oleh')->constrained('users');
            $table->timestamp('expired_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barcode_harians');
    }
};
