@extends('main')

@section('title', '| Edit post')

@section('stylesheets')

	{!! Html::style('css/select2.min.css')  !!}
	{!! Html::style('css/parsley.css')  !!}
	<script src="//cloud.tinymce.com/stable/tinymce.min.js"></script>

	<script>
		tinymce.init({
			selector: 'textarea';
		});
	</script>

@endsection

@section('content')

	<div class="row">
	{!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT']) !!}
		<div class="col-md-8">
			{{ Form::label('title', 'Title')}}
			{{ Form::text('title', null, ["class" => 'form-control input-lg']) }}
			<hr>
			{{ Form::label('slug', 'Slug')}}
			{{ Form::text('slug', null, ["class" => 'form-control form-spacing-top']) }}
			<br>

			{{ Form::label('category_id', 'Category')}}
			{{ Form::select('category_id', $categories, null, ["class" => 'form-control form-spacing-top']) }}

			{{ Form::label('featured_image', 'Upload Image:')}}
			 		{{ Form::file('featured_image') }}

			{{ Form::label('body', 'Body', ["class" => 'form-spacing-top'])}}
			{{ Form::textarea('body', null, ["class" => 'form-control']) }}
			<hr>

		</div>
		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<dt>Created at:</dt>
					<dd> {{ date('M j Y h:ia', strtotime( $post -> created_at)) }}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>Last updated:</dt>
					<dd>{{ date('M j Y h:ia', strtotime($post -> updated_at)) }}</dd>
				</dl>
				<hr>
				<div class="row">
					<div class="col-md-6">
					{!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-primary btn-block')) !!}
					</div>
					<div class="col-md-6">
						{{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block'])}}
					</div>
				</div>
			</div>
		</div>
		{!! Form::close() !!}
	</div>

@endsection

@section('scripts')

	{!! Html::script('js/select2.min.js')  !!}
	{!! Html::script('js/parsley.min.js')  !!}

@endsection