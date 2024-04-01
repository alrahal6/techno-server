@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{{ Form::model($meter_service, array('route' => array('meter_services.update', $meter_service->id), 'method' => 'PUT')) }}

		<div class="mb-3">
			{{ Form::label('meter_id', 'Meter_id', ['class'=>'form-label']) }}
			{{ Form::text('meter_id', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('service_status', 'Service_status', ['class'=>'form-label']) }}
			{{ Form::text('service_status', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('problem_note', 'Problem_note', ['class'=>'form-label']) }}
			{{ Form::text('problem_note', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('service_note', 'Service_note', ['class'=>'form-label']) }}
			{{ Form::text('service_note', null, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}
@stop
