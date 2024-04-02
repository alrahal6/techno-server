<!-- resources/views/reports/index.blade.php -->

<form action="{{ route('report.show') }}" method="post">
    @csrf
    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date">
    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date">
    <button type="submit">Generate Report</button>
</form>
