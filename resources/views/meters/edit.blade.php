@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{{ Form::model($meter, array('route' => array('meters.update', $meter->id), 'method' => 'PUT')) }}

		<div class="mb-3">
			{{ Form::label('meter_number', 'Meter_number', ['class'=>'form-label']) }}
			{{ Form::text('meter_number', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('meter_name', 'Meter_name', ['class'=>'form-label']) }}
			{{ Form::text('meter_name', null, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}
@stop
