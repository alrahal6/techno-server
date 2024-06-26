<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConnectionReport extends Model
{
    use HasFactory;

    protected $table = 'connections';

    public static function filterByDateRange($startDate, $endDate)
    {
        //return self::whereBetween('connection_date', [$startDate, $endDate]);
        return Connection::all();
    }

}
