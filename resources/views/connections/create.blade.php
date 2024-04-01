@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{!! Form::open(['route' => 'connections.store']) !!}

		<div class="mb-3">
			{{ Form::label('number_of_meters', 'Number_of_meters', ['class'=>'form-label']) }}
			{{ Form::text('number_of_meters', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('location_id', 'Location_id', ['class'=>'form-label']) }}
			{{ Form::text('location_id', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('connection_date', 'Connection_date', ['class'=>'form-label']) }}
			{{ Form::text('connection_date', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('amc_per_connection', 'Amc_per_connection', ['class'=>'form-label']) }}
			{{ Form::text('amc_per_connection', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('connection_status', 'Connection_status', ['class'=>'form-label']) }}
			{{ Form::text('connection_status', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('admin_name', 'Admin_name', ['class'=>'form-label']) }}
			{{ Form::text('admin_name', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('amc_duration', 'Amc_duration', ['class'=>'form-label']) }}
			{{ Form::text('amc_duration', null, array('class' => 'form-control')) }}
		</div>


		{{ Form::submit('Create', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}


@stop