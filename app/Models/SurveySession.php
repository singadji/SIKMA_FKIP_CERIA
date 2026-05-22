<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveySession extends Model
{
    protected $table = "survey_sessions";
    protected $fillable = [
        "mahasiswa_id",
        "tahun_akademik",
        "semester",
        "tanggal_survey",
        "status_selesai",
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function answers()
    {
        return $this->hasMany(SurveyAnswer::class, "session_id");
    }
}
