@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('load_limits.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>meter_id</th>
				<th>channel</th>
				<th>load_limit</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($load_limits as $load_limit)

				<tr>
					<td>{{ $load_limit->id }}</td>
					<td>{{ $load_limit->meter_id }}</td>
					<td>{{ $load_limit->channel }}</td>
					<td>{{ $load_limit->load_limit }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('load_limits.show', [$load_limit->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('load_limits.edit', [$load_limit->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['load_limits.destroy', $load_limit->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
