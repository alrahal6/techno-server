<?php

namespace App\Http\Controllers;

use App\Models\Meter;

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

}