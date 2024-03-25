@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{{ Form::model($year, array('route' => array('years.update', $year->id), 'method' => 'PUT')) }}

		
	    <div class="mb-3">
			{{ Form::label('meter_id', 'Meter_id', ['class'=>'form-label']) }}
			{{ Form::select('meter_id', $meters, null,['placeholder' => 'Please select ...'], array('class' => 'form-control') ) }}
		</div>
		<div class="mb-3">
			{{ Form::label('channel', 'Channel', ['class'=>'form-label']) }}
			{{ Form::select('channel',$channels, null,['placeholder' => 'Please select ...'], array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('year', 'Year', ['class'=>'form-label']) }}
			{{ Form::text('year', null, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}
@stop
