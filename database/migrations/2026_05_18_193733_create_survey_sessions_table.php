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
        Schema::create("survey_sessions", function (Blueprint $table) {
            $table->id();

            $table
                ->foreignId("mahasiswa_id")
                ->constrained("mahasiswa")
                ->cascadeOnDelete();

            $table->string("tahun_akademik");
            $table->string("semester");

            $table->dateTime("tanggal_survey");

            $table->boolean("status_selesai")->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("survey_sessions");
    }
};
