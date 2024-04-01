@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{{ Form::model($connection_status, array('route' => array('connection_statuses.update', $connection_status->id), 'method' => 'PUT')) }}

		<div class="mb-3">
			{{ Form::label('status_name', 'Status_name', ['class'=>'form-label']) }}
			{{ Form::text('status_name', null, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}
@stop
