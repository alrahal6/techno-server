@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('years.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>meter_id</th>
				<th>channel</th>
				<th>year</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($years as $year)

				<tr>
					<td>{{ $year->id }}</td>
					<td>{{ $year->meter_id }}</td>
					<td>{{ $year->channel }}</td>
					<td>{{ $year->year }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('years.show', [$year->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('years.edit', [$year->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['years.destroy', $year->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
