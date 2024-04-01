@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('connection_statuses.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>status_name</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($connection_statuses as $connection_status)

				<tr>
					<td>{{ $connection_status->id }}</td>
					<td>{{ $connection_status->status_name }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('connection_statuses.show', [$connection_status->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('connection_statuses.edit', [$connection_status->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['connection_statuses.destroy', $connection_status->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
