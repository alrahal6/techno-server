<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overload_delay_time extends Model
{
    use HasFactory;

	public function meter()
	{
		return $this->belongsTo('App\Models\Meter');
	}

	public function channel()
	{
		return $this->belongsTo('App\Models\Channel');
	}
}
