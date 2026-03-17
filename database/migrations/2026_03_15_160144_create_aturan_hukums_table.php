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
        Schema::create('aturan_hukums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_pelanggaran_id')->constrained()->cascadeOnDelete();
            $table->integer('min_nilai');
            $table->integer('max_nilai')->nullable();
            $table->text('hukuman');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aturan_hukums');
    }
};
