<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
	protected $fillable = ['name', 'city_id', 'line_type_id', 'color_background', 'color_foreground'];


	public function city() {
        return $this->belongsTo(City::class);
    }

    public function lineType() {
        return $this->belongsTo(LineType::class);
    }

    public function stations() {
        return $this->belongsToMany(Station::class)->withPivot('position')->orderBy('position', 'asc');
    }
}
