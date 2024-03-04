@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{!! Form::open(['route' => 'admins.store']) !!}

		<div class="mb-3">
			{{ Form::label('adminname', 'Adminname', ['class'=>'form-label']) }}
			{{ Form::text('adminname', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('mobile', 'Mobile', ['class'=>'form-label']) }}
			{{ Form::text('mobile', null, array('class' => 'form-control')) }}
		</div>


		{{ Form::submit('Create', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}


@stop