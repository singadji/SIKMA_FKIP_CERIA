<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyInstrument extends Model
{
    public function categories()
    {
        return $this->hasMany(SurveyCategory::class, "instrument_id");
    }
}
