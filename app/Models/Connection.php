<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    use HasFactory;

	public function connaction_status()
	{
		return $this->belongsTo('App\Models\Connaction_status');
	}
}
