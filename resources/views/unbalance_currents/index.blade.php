@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('unbalance_currents.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>meter_id</th>
				<th>channel</th>
				<th>ub_current</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($unbalance_currents as $unbalance_current)

				<tr>
					<td>{{ $unbalance_current->id }}</td>
					<td>{{ $unbalance_current->meter_id }}</td>
					<td>{{ $unbalance_current->channel }}</td>
					<td>{{ $unbalance_current->ub_current }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('unbalance_currents.show', [$unbalance_current->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('unbalance_currents.edit', [$unbalance_current->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['unbalance_currents.destroy', $unbalance_current->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
