<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyAnswer extends Model
{
    protected $table = "survey_answers";
    protected $fillable = [
        "session_id",
        "instrument_id",
        "question_id",
        "jawaban",
        "dosen_id",
        "mata_kuliah_id",
        "dosen",
        "mata_kuliah",
    ];

    public function session()
    {
        return $this->belongsTo(SurveySession::class, "session_id");
    }

    public function question()
    {
        return $this->belongsTo(SurveyQuestion::class, "question_id");
    }
}
