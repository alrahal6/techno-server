@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{!! Form::open(['route' => 'unbalance_currents.store']) !!}

		<div class="mb-3">
			{{ Form::label('meter_id', 'Meter_id', ['class'=>'form-label']) }}
			{{ Form::text('meter_id', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('channel', 'Channel', ['class'=>'form-label']) }}
			{{ Form::text('channel', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('ub_current', 'Ub_current', ['class'=>'form-label']) }}
			{{ Form::text('ub_current', null, array('class' => 'form-control')) }}
		</div>


		{{ Form::submit('Create', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}


@stop