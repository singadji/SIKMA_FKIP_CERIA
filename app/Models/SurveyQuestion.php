<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SurveyQuestion extends Model
{
    use SoftDeletes;

    protected $table = "survey_questions";
    protected $fillable = [
        "instrument_id",
        "category_id",
        "nomor",
        "pertanyaan",
    ];
    public function category()
    {
        return $this->belongsTo(SurveyCategory::class, "category_id");
    }
    public function answers()
    {
        return $this->hasMany(SurveyAnswer::class, "question_id");
    }
    public function instrument()
    {
        return $this->belongsTo(SurveyInstrument::class, "instrument_id");
    }
}
