<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('nilai_rapors', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->primary();
            $table->integer('rapor_id');
            $table->integer('kriteria_id');
            $table->text('deskripsi')->nullable();
            $table->string('foto', 255)->nullable();
            $table->timestamps();

            $table->foreign('rapor_id')->references('id')->on('rapors')->onDelete('cascade');
            $table->foreign('kriteria_id')->references('id')->on('kriteria_penilaians')->onDelete('cascade');

            $table->unique(['rapor_id', 'kriteria_id']); // 1 rapor 1 baris per kriteria
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai_rapors');
    }
};
