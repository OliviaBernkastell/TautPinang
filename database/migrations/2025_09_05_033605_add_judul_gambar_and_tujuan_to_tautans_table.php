<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tautans', function (Blueprint $table) {
            // Kolom judul_gambar - nullable, hanya terisi jika upload gambar
            $table->string('judul_gambar')->nullable()->after('logo_url')
                ->comment('Nama file gambar yang diupload (contoh: bps-tanjungpinang.html), hanya terisi jika menggunakan upload gambar');

            // Kolom tujuan - default 'external' untuk form ini
            $table->enum('tujuan', ['external', 'internal'])->default('external')->after('is_active')
                ->comment('Tujuan penggunaan: external (untuk GitHub Pages) atau internal (untuk sistem internal)');

            // Tambahan: kolom use_uploaded_logo untuk tracking apakah menggunakan upload atau URL
            $table->boolean('use_uploaded_logo')->default(false)->after('logo_url')
                ->comment('True jika menggunakan upload gambar, false jika menggunakan URL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tautans', function (Blueprint $table) {
            $table->dropColumn(['judul_gambar', 'tujuan', 'use_uploaded_logo']);
        });
    }
};
