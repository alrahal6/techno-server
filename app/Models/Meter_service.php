<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meter_service extends Model
{
    use HasFactory;

	public function service_status()
	{
		return $this->belongsTo('App\Models\Service_status');
	}
}
