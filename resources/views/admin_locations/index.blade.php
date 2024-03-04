@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('admin_locations.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>admin_id</th>
				<th>location_id</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($admin_locations as $admin_location)

				<tr>
					<td>{{ $admin_location->id }}</td>
					<td>{{ $admin_location->admin_id }}</td>
					<td>{{ $admin_location->location_id }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('admin_locations.show', [$admin_location->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('admin_locations.edit', [$admin_location->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['admin_locations.destroy', $admin_location->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
