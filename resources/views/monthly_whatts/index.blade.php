@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('monthly_whatts.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>meter_id</th>
				<th>channel</th>
				<th>whatt</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($monthly_whatts as $monthly_whatt)

				<tr>
					<td>{{ $monthly_whatt->id }}</td>
					<td>{{ $monthly_whatt->meter_id }}</td>
					<td>{{ $monthly_whatt->channel }}</td>
					<td>{{ $monthly_whatt->whatt }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('monthly_whatts.show', [$monthly_whatt->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('monthly_whatts.edit', [$monthly_whatt->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['monthly_whatts.destroy', $monthly_whatt->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
