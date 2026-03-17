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
        Schema::create('pelanggaran_siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->cascadeOnDelete();
            $table->foreignId('barcode_id')->constrained('barcode_harians')->cascadeOnDelete();
            $table->foreignId('aturan_id')->nullable()->constrained('aturan_hukums')->nullOnDelete();
            $table->integer('nilai');
            $table->text('hukuman_override')->nullable();
            $table->timestamp('scan_at');
            $table->enum('status', ['pending', 'selesai', 'dikecualikan'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggaran_siswas');
    }
};
