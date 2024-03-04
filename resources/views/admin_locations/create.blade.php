@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{!! Form::open(['route' => 'admin_locations.store']) !!}

		<div class="mb-3">
			{{ Form::label('admin_id', 'Admin_id', ['class'=>'form-label']) }}
			{{ Form::text('admin_id', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('location_id', 'Location_id', ['class'=>'form-label']) }}
			{{ Form::text('location_id', null, array('class' => 'form-control')) }}
		</div>


		{{ Form::submit('Create', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}


@stop