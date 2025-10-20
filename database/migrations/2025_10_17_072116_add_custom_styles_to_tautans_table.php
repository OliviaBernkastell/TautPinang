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
            $table->json('custom_styles')->nullable()->after('styles')->comment('Custom styles that override global styles for this specific tautan');
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
            $table->dropColumn('custom_styles');
        });
    }
};
