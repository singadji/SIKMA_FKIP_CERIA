<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class SurveySession extends Model
{
    use SoftDeletes;

    protected $table = "survey_sessions";
    protected $fillable = [
        "mahasiswa_id",
        "tahun_akademik",
        "semester",
        "tanggal_survey",
        "status_selesai",
        "uuid",
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function answers()
    {
        return $this->hasMany(SurveyAnswer::class, "session_id");
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->uuid) {
                $model->uuid = Str::uuid();
            }
        });
    }

    public function getRouteKeyName()
    {
        return "uuid";
    }
}
