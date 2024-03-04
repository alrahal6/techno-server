@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('overload_delay_times.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>meter_id</th>
				<th>channel</th>
				<th>seconds</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($overload_delay_times as $overload_delay_time)

				<tr>
					<td>{{ $overload_delay_time->id }}</td>
					<td>{{ $overload_delay_time->meter_id }}</td>
					<td>{{ $overload_delay_time->channel }}</td>
					<td>{{ $overload_delay_time->seconds }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('overload_delay_times.show', [$overload_delay_time->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('overload_delay_times.edit', [$overload_delay_time->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['overload_delay_times.destroy', $overload_delay_time->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
