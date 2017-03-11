@extends('main')

@section('title', '| Create new post')

@section('stylesheets')

	{!! Html::style('css/select2.min.css')  !!}
	{!! Html::style('css/parsley.css')  !!}


@endsection

@section('content')

	<div class="row">
		<div class="cpl-md-8 col-md-offset-2">
			<h1>Create new post</h1>
			<hr>
			 	{!! Form::open(array('route' => 'posts.store', 'data-parsley-validate' => '', 'files' => true)) !!}
			 		{{ Form::label('title', 'Title:')}}
			 		{{ Form::text('title', null, array('class' =>'form-control', 'required' => '', 'minlength' => '5'))}}

			 		{{ Form::label('slug', 'Slug:')}}
			 		{{ Form::text('slug', null, array('class' =>'form-control', 'required' => '', 'minlength' => '5'))}}

			 		{{ Form::label('category_id', 'Category:')}}
			 		<select class="form-control" name="category_id">
			 		@foreach($categories as $category)
			 			<option value="{{ $category-> id}}">{{ $category-> name}}</option>
			 		@endforeach
			 		</select>

			 		{{ Form::label('featured_image', 'Upload Image:')}}
			 		{{ Form::file('featured_image') }}

			 		{{ Form::label('body', 'Post body:')}}
			 		{{ Form::textarea('body', null, array('class' =>'form-control' ))}}

			 		{{ Form::submit('Create Post',array('class' =>'btn btn-success btn-lg btn-block', 'style' => 'margin-top:20px'))}}
				{!! Form::close() !!}
		</div>
	</div>



@endsection

@section('scripts')

	{!! Html::script('js/select2.min.js')  !!}
	{!! Html::script('js/parsley.min.js')  !!}

	<script type="text/javascript">
		$('.select2-multi').select2();
	</script>

@endsection

