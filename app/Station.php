<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
	protected $fillable = ['name', 'latitude', 'longitude', 'city_id'];

	public function city() {
        return $this->belongsTo(City::class);
    }

    public function lines() {
        return $this->belongsToMany(Line::class)->withPivot('position')->orderBy('name', 'asc');
    }
}
