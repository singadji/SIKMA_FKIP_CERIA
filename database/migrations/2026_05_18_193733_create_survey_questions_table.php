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
        Schema::create('survey_questions', function (Blueprint $table) {
            $table->id();
        
            $table->foreignId('instrument_id')
                ->constrained('survey_instruments')
                ->cascadeOnDelete();
        
            $table->foreignId('category_id')
                ->constrained('survey_categories')
                ->cascadeOnDelete();
        
            $table->integer('nomor');
        
            $table->text('pertanyaan');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_questions');
    }
};
