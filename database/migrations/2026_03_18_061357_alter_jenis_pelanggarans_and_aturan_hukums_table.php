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
        Schema::table('jenis_pelanggarans', function (Blueprint $table) {
            $table->dropColumn(['satuan', 'is_akumulatif']);
            $table->enum('tipe_perhitungan', ['otomatis_waktu', 'langsung'])->default('langsung')->after('kategori');
            $table->time('jam_batas_masuk')->nullable()->after('tipe_perhitungan');
        });

        Schema::table('aturan_hukums', function (Blueprint $table) {
            $table->integer('poin_pelanggaran')->default(0)->after('jenis_pelanggaran_id');
        });
    }

    public function down(): void
    {
        Schema::table('jenis_pelanggarans', function (Blueprint $table) {
            $table->string('satuan', 30)->default('langsung');
            $table->boolean('is_akumulatif')->default(false);
            $table->dropColumn(['tipe_perhitungan', 'jam_batas_masuk']);
        });

        Schema::table('aturan_hukums', function (Blueprint $table) {
            $table->dropColumn('poin_pelanggaran');
        });
    }
};
