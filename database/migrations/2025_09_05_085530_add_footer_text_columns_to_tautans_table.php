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
            // Tambah kolom footer yang hilang
            $table->string('footer_text_1')->nullable()->after('use_uploaded_logo')
                ->comment('Teks footer baris pertama');

            $table->string('footer_text_2')->nullable()->after('footer_text_1')
                ->comment('Teks footer baris kedua');
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
            $table->dropColumn(['footer_text_1', 'footer_text_2']);
        });
    }
};
