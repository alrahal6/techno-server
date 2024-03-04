<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meter_location extends Model
{
    use HasFactory;

	public function meter()
	{
		return $this->belongsTo('App\Models\Meter');
	}

	public function location()
	{
		return $this->belongsTo('App\Models\Location');
	}
}
