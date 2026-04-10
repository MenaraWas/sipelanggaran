<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('alasan_pelanggarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_pelanggaran_id')->constrained('jenis_pelanggarans')->cascadeOnDelete();
            $table->string('teks');
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alasan_pelanggarans');
    }
};
