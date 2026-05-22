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
        Schema::create("survey_answers", function (Blueprint $table) {
            $table->id();

            $table
                ->foreignId("session_id")
                ->constrained("survey_sessions")
                ->cascadeOnDelete();

            $table
                ->foreignId("instrument_id")
                ->constrained("survey_instruments");

            $table->foreignId("question_id")->constrained("survey_questions");

            $table->tinyInteger("jawaban");

            $table->foreignId("dosen_id")->nullable()->constrained("dosen");

            $table
                ->foreignId("mata_kuliah_id")
                ->nullable()
                ->constrained("mata_kuliah");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("survey_answers");
    }
};
