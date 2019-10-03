<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LineType extends Model
{
	public function city() {
        return $this->belongsTo(City::class);
    }

    public function lines() {
        return $this->hasMany(Line::class);
    }
}
