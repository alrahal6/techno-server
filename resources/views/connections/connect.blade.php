<!-- resources/views/reports/index.blade.php -->
@extends('default')

@section('content')
<form action="{{ route('connections.report') }}" method="post" target="_blank">
    @csrf
    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date">
    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date">
    <br/><br/>
    <button text-align="center" type="submit">Generate Report</button>
</form>

@stop
