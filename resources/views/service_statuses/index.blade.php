@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('service_statuses.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>status_name</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($service_statuses as $service_status)

				<tr>
					<td>{{ $service_status->id }}</td>
					<td>{{ $service_status->status_name }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('service_statuses.show', [$service_status->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('service_statuses.edit', [$service_status->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['service_statuses.destroy', $service_status->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
