<?php

namespace App\Http\Controllers;

use App\Models\Meter;
use App\Models\Channel;


class Items {

    // @TODO fetch from database
    static $dayMonth = 1;
    static $year = 2;
    static $load_limit = 3;
    static $max_current = 4;
    static $monthly_tariff = 5;
    static $monthly_watts = 6;
    static $overload_delay_time = 7;
    static $tod_one_start = 8;
    static $tod_one_end = 9;
    static $tod_two_start = 10;
    static $tod_two_end = 11;
    static $unbalance_current = 12;

    public static function getMeter() {
        return Meter::all()->pluck('meter_number','id');
    } 

    public static function getChannel() {
        return Channel::all()->pluck('channel','id');
    }

}