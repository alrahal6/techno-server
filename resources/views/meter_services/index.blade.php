@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('meter_services.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>meter_id</th>
				<th>service_status</th>
				<th>problem_note</th>
				<th>service_note</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($meter_services as $meter_service)

				<tr>
					<td>{{ $meter_service->id }}</td>
					<td>{{ $meter_service->meter_id }}</td>
					<td>{{ $meter_service->service_status }}</td>
					<td>{{ $meter_service->problem_note }}</td>
					<td>{{ $meter_service->service_note }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('meter_services.show', [$meter_service->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('meter_services.edit', [$meter_service->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['meter_services.destroy', $meter_service->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
