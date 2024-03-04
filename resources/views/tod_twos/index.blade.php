@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('tod_twos.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>meter_id</th>
				<th>channel</th>
				<th>starttime</th>
				<th>endtime</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($tod_twos as $tod_two)

				<tr>
					<td>{{ $tod_two->id }}</td>
					<td>{{ $tod_two->meter_id }}</td>
					<td>{{ $tod_two->channel }}</td>
					<td>{{ $tod_two->starttime }}</td>
					<td>{{ $tod_two->endtime }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('tod_twos.show', [$tod_two->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('tod_twos.edit', [$tod_two->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['tod_twos.destroy', $tod_two->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
