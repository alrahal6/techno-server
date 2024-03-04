@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{{ Form::model($admin_location, array('route' => array('admin_locations.update', $admin_location->id), 'method' => 'PUT')) }}

		<div class="mb-3">
			{{ Form::label('admin_id', 'Admin_id', ['class'=>'form-label']) }}
			{{ Form::text('admin_id', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('location_id', 'Location_id', ['class'=>'form-label']) }}
			{{ Form::text('location_id', null, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}
@stop
