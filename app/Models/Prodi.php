<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prodi extends Model
{
    use SoftDeletes;

    protected $table = "prodi";

    protected $fillable = ["kode_prodi", "nama_prodi", "jurusan_id"];

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function update_by($user_id)
    {
        $this->updated_by = $user_id;
        $this->save();
    }

    public function getRouteKeyName()
    {
        return "uuid";
    }
}
