<!-- resources/views/reports/report.blade.php -->

<h1>Connection Report</h1>

<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Number Of Meters</th>
            <th>Connaction Status</th>
            <th>Amc Amount</th>
            <th>AMC Duration/Charges</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reportData as $data)
            <tr>
                <td>{{ $data['connection_date'] }}</td>
                <td>{{ $data['number_of_meters'] }}</td>
                <td>{{ $data['connection_status'] }}</td>
                <td>{{ $data['amc_per_connaction'] }}</td>
                <td>{{ $data['amc_duration'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
