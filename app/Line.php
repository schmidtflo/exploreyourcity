<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    public function city() {
        return $this->belongsTo(City::class);
    }

    public function lineType() {
        return $this->belongsTo(LineType::class);
    }

    public function stations() {
        return $this->belongsToMany(Station::class);
    }
}
