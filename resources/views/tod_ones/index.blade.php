@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('tod_ones.create') }}" class="btn btn-info">Create</a></div>

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
			@foreach($tod_ones as $tod_one)

				<tr>
					<td>{{ $tod_one->id }}</td>
					<td>{{ $tod_one->meter_id }}</td>
					<td>{{ $tod_one->channel }}</td>
					<td>{{ $tod_one->starttime }}</td>
					<td>{{ $tod_one->endtime }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('tod_ones.show', [$tod_one->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('tod_ones.edit', [$tod_one->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['tod_ones.destroy', $tod_one->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
