<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConnectionReport;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function show(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        // Filter data based on date range
        $reportData = ConnectionReport::filterByDateRange($startDate, $endDate)->get();

        return view('reports.report', compact('reportData'));
    }
}