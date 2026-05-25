<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mahasiswa extends Model
{
    use SoftDeletes;

    protected $table = "mahasiswa";

    protected $fillable = [
        "uuid",
        "nim",
        "nama",
        "prodi_id",
        "jurusan",
        "status_aktif",
        "created_by",
        "updated_by",
        "deleted_by",
    ];

    protected $casts = [
        "created_at" => "datetime",
        "updated_at" => "datetime",
        "deleted_at" => "datetime",
    ];

    public function sessions()
    {
        return $this->hasMany(SurveySession::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
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
