@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('admins.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>adminname</th>
				<th>mobile</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($admins as $admin)

				<tr>
					<td>{{ $admin->id }}</td>
					<td>{{ $admin->adminname }}</td>
					<td>{{ $admin->mobile }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('admins.show', [$admin->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('admins.edit', [$admin->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['admins.destroy', $admin->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
