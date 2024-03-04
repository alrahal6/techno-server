@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('meter_locations.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>meter_id</th>
				<th>location_id</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($meter_locations as $meter_location)

				<tr>
					<td>{{ $meter_location->id }}</td>
					<td>{{ $meter_location->meter_id }}</td>
					<td>{{ $meter_location->location_id }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('meter_locations.show', [$meter_location->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('meter_locations.edit', [$meter_location->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['meter_locations.destroy', $meter_location->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
