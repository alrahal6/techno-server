@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('channels.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>channel</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($channels as $channel)

				<tr>
					<td>{{ $channel->id }}</td>
					<td>{{ $channel->channel }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('channels.show', [$channel->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('channels.edit', [$channel->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['channels.destroy', $channel->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
