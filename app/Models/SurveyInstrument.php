<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class SurveyInstrument extends Model
{
    use SoftDeletes;

    protected $table = "survey_instruments";
    protected $fillable = [
        "uuid",
        "kode",
        "nama_instrumen",
        "deskripsi",
        "is_active",
        "created_at",
        "updated_at",
        "deleted_at",
        "updated_by",
    ];

    public function categories()
    {
        return $this->hasMany(SurveyCategory::class, "instrument_id");
    }

    public function update_by($user_id)
    {
        $this->updated_by = $user_id;
        $this->save();
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
