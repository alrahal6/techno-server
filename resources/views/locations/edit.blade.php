@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{{ Form::model($location, array('route' => array('locations.update', $location->id), 'method' => 'PUT')) }}

		<div class="mb-3">
			{{ Form::label('id', 'Id', ['class'=>'form-label']) }}
			{{ Form::text('id', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('locationname', 'Locationname', ['class'=>'form-label']) }}
			{{ Form::text('locationname', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('address', 'Address', ['class'=>'form-label']) }}
			{{ Form::text('address', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('lat', 'Lat', ['class'=>'form-label']) }}
			{{ Form::text('lat', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('lng', 'Lng', ['class'=>'form-label']) }}
			{{ Form::text('lng', null, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}
@stop
