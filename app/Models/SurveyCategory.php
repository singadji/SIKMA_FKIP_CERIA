<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyCategory extends Model
{
    public function questions()
    {
        return $this->hasMany(SurveyQuestion::class, "category_id");
    }
}
