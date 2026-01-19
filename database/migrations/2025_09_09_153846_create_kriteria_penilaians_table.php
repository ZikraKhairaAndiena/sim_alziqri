<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kriteria_penilaians', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->primary();
            $table->string('nama_kriteria', 100);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kriteria_penilaians');
    }
};
