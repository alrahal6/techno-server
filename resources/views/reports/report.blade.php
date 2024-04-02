<!-- resources/views/reports/report.blade.php -->

<h1>Connection Report</h1>

<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Active Connections</th>
            <th>New Connections</th>
            <th>Total Connections</th>
            <th>AMC Duration/Charges</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reportData as $data)
            <tr>
                <td>{{ $data['date'] }}</td>
                <td>{{ $data['active_connections'] }}</td>
                <td>{{ $data['new_connections'] }}</td>
                <td>{{ $data['total_connections'] }}</td>
                <td>{{ $data['amc_duration_charges'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
