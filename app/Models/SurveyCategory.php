<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class SurveyCategory extends Model
{
    use SoftDeletes;

    protected $table = "survey_categories";
    protected $fillable = [
        "uuid",
        "instrument_id",
        "nama_kategori",
        "deskripsi",
        "urutan",
        "created_at",
        "updated_at",
        "deleted_at",
        "updated_by",
    ];
    public function questions()
    {
        return $this->hasMany(SurveyQuestion::class, "category_id");
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
