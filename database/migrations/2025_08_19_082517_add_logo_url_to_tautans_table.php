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
            // Add logo_url field if it doesn't exist
            if (!Schema::hasColumn('tautans', 'logo_url')) {
                $table->string('logo_url', 500)->nullable()->after('styles');
            }

            // Ensure styles column exists and is properly configured
            if (!Schema::hasColumn('tautans', 'styles')) {
                $table->json('styles')->nullable()->after('links');
            }
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
            // Drop logo_url column
            if (Schema::hasColumn('tautans', 'logo_url')) {
                $table->dropColumn('logo_url');
            }
        });
    }
};
