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
        Schema::create("mahasiswa", function (Blueprint $table) {
            $table->id();

            $table->string("nim")->unique();
            $table->string("nama");

            $table->foreignId("jurusan_id")->constrained("jurusan");

            $table->foreignId("prodi_id")->constrained("prodi");

            $table->integer("semester")->nullable();
            $table->year("angkatan")->nullable();

            $table->boolean("status_aktif")->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("mahasiswa");
    }
};
