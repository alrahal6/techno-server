@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{!! Form::open(['route' => 'monthly_whatts.store']) !!}

		
	    <div class="mb-3">
			{{ Form::label('meter_id', 'Meter_id', ['class'=>'form-label']) }}
			{{ Form::select('meter_id', $meters, null,['placeholder' => 'Please select ...'], array('class' => 'form-control') ) }}
		</div>
		<div class="mb-3">
			{{ Form::label('channel', 'Channel', ['class'=>'form-label']) }}
			{{ Form::select('channel',$channels, null,['placeholder' => 'Please select ...'], array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('whatt', 'Whatt', ['class'=>'form-label']) }}
			{{ Form::text('whatt', null, array('class' => 'form-control')) }}
		</div>


		{{ Form::submit('Create', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}


@stop