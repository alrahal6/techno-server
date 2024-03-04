@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('meters.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>meter_number</th>
				<th>meter_name</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($meters as $meter)

				<tr>
					<td>{{ $meter->id }}</td>
					<td>{{ $meter->meter_number }}</td>
					<td>{{ $meter->meter_name }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('meters.show', [$meter->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('meters.edit', [$meter->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['meters.destroy', $meter->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
