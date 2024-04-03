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
    <div text-align="center"><button type="submit">Generate Report</button></div>
</form>

@stop
