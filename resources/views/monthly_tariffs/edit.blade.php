@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{{ Form::model($monthly_tariff, array('route' => array('monthly_tariffs.update', $monthly_tariff->id), 'method' => 'PUT')) }}

		<div class="mb-3">
			{{ Form::label('meter_id', 'Meter_id', ['class'=>'form-label']) }}
			{{ Form::text('meter_id', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('channel', 'Channel', ['class'=>'form-label']) }}
			{{ Form::text('channel', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('tariff', 'Tariff', ['class'=>'form-label']) }}
			{{ Form::text('tariff', null, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}
@stop
