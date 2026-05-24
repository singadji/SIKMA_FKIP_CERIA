<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Modul extends Model
{
    use SoftDeletes;

    protected $table = "modul";

    protected $fillable = [
        "uuid",
        "nama_modul",
        "url",
        "aktif",
        "role_id",
        "icon",
        "par",
        "slug",
        "folder",
        "created_by",
        "updated_by",
        "deleted_at",
        "created_at",
        "updated_at",
    ];

    protected $casts = [
        "aktif" => "boolean",
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    /**
     * Parent menu
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Modul::class, "par");
    }

    /**
     * Child menu
     */
    public function children(): HasMany
    {
        return $this->hasMany(Modul::class, "par");
    }

    public function scopeActive($query)
    {
        return $query->where("aktif", 1);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function getRouteKeyName()
    {
        return "uuid";
    }
}
