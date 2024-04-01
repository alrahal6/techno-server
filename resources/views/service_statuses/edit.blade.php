@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{{ Form::model($service_status, array('route' => array('service_statuses.update', $service_status->id), 'method' => 'PUT')) }}

		<div class="mb-3">
			{{ Form::label('status_name', 'Status_name', ['class'=>'form-label']) }}
			{{ Form::text('status_name', null, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}
@stop
