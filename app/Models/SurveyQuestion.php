<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model
{
    public function category()
    {
        return $this->belongsTo(SurveyCategory::class, "category_id");
    }
}
