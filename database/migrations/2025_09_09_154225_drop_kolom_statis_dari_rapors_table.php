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
        Schema::table('rapors', function (Blueprint $table) {
            $table->dropColumn([
                'agama',
                'foto_agama',
                'jati_diri',
                'foto_jati_diri',
                'literasi',
                'foto_literasi',
                'steam',
                'foto_steam'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rapors', function (Blueprint $table) {
            $table->text('agama')->nullable();
            $table->string('foto_agama', 255)->nullable();
            $table->text('jati_diri')->nullable();
            $table->string('foto_jati_diri', 255)->nullable();
            $table->text('literasi')->nullable();
            $table->string('foto_literasi', 255)->nullable();
            $table->text('steam')->nullable();
            $table->string('foto_steam', 255)->nullable();
        });
    }
};
