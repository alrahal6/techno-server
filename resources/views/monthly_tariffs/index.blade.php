@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('monthly_tariffs.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>meter_id</th>
				<th>channel</th>
				<th>tariff</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($monthly_tariffs as $monthly_tariff)

				<tr>
					<td>{{ $monthly_tariff->id }}</td>
					<td>{{ $monthly_tariff->meter_id }}</td>
					<td>{{ $monthly_tariff->channel }}</td>
					<td>{{ $monthly_tariff->tariff }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('monthly_tariffs.show', [$monthly_tariff->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('monthly_tariffs.edit', [$monthly_tariff->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['monthly_tariffs.destroy', $monthly_tariff->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
