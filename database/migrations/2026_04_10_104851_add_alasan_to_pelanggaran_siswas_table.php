<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pelanggaran_siswas', function (Blueprint $table) {
            $table->foreignId('alasan_id')->nullable()->after('aturan_id')->constrained('alasan_pelanggarans')->nullOnDelete();
            $table->text('alasan_custom')->nullable()->after('alasan_id');
        });
    }

    public function down(): void
    {
        Schema::table('pelanggaran_siswas', function (Blueprint $table) {
            $table->dropForeign(['alasan_id']);
            $table->dropColumn(['alasan_id', 'alasan_custom']);
        });
    }
};
