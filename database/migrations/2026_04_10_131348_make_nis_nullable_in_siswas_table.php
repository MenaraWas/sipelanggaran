<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            // NIS boleh kosong untuk siswa yang daftar sendiri via scan
            // Admin bisa mengisi NIS nanti saat verifikasi
            $table->string('nis', 20)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->string('nis', 20)->nullable(false)->unique()->change();
        });
    }
};
