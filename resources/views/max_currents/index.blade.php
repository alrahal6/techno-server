@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('max_currents.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>meter_id</th>
				<th>channel</th>
				<th>mx_current</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($max_currents as $max_current)

				<tr>
					<td>{{ $max_current->id }}</td>
					<td>{{ $max_current->meter_id }}</td>
					<td>{{ $max_current->channel }}</td>
					<td>{{ $max_current->mx_current }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('max_currents.show', [$max_current->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('max_currents.edit', [$max_current->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['max_currents.destroy', $max_current->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
