@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('connections.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>number_of_meters</th>
				<th>location_id</th>
				<th>connection_date</th>
				<th>amc_per_connection</th>
				<th>connection_status</th>
				<th>admin_name</th>
				<th>amc_duration</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($connections as $connection)

				<tr>
					<td>{{ $connection->id }}</td>
					<td>{{ $connection->number_of_meters }}</td>
					<td>{{ $connection->location_id }}</td>
					<td>{{ $connection->connection_date }}</td>
					<td>{{ $connection->amc_per_connection }}</td>
					<td>{{ $connection->connection_status }}</td>
					<td>{{ $connection->admin_name }}</td>
					<td>{{ $connection->amc_duration }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('connections.show', [$connection->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('connections.edit', [$connection->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['connections.destroy', $connection->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
