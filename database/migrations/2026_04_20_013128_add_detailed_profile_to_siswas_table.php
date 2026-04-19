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
        Schema::table('siswas', function (Blueprint $table) {
            $table->string('nik', 20)->nullable()->unique()->after('nama');
            $table->string('tempat_lahir')->nullable()->after('nik');
            $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            $table->string('jenis_kelamin', 20)->nullable()->after('tanggal_lahir');
            $table->text('alamat')->nullable()->after('jenis_kelamin');
            $table->string('no_telepon', 20)->nullable()->after('alamat');
            $table->string('nama_ayah', 100)->nullable()->after('no_telepon');
            $table->string('nama_ibu', 100)->nullable()->after('nama_ayah');
            $table->string('nama_wali', 100)->nullable()->after('nama_ibu');
            $table->string('jurusan', 50)->nullable()->change(); // Make nullable as per request
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropColumn([
                'nik', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 
                'alamat', 'no_telepon', 'nama_ayah', 'nama_ibu', 'nama_wali'
            ]);
            $table->string('jurusan', 50)->nullable(false)->change();
        });
    }
};
