<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin_location extends Model
{
    use HasFactory;

	public function admin()
	{
		return $this->belongsTo('App\Models\Admin');
	}

	public function location()
	{
		return $this->belongsTo('App\Models\Location');
	}
}
