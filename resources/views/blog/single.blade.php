@extends('main')

<?php $titleTag = htmlspecialchars($post->title); ?>

@section('title', "| $titleTag")

@section('content')

<div class="row">
	<div class="col-md-8 col-md-offset-2">
	<img src="{{ asset('images/'.$post->image) }}" height="300" width="680" />
		<h1>{{ $post->title }}</h1>
		<hr>
		<h3>Posted In: {{ $post->category->name }}</h3>
		<p>{!! $post->body !!}</p>
	</div>
</div>
<div class="row">
	<div id="comment-form" class="col-md-8 col-md-offset-2">
		{{ Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST'])}}

		<div class="row">
			<div class="col-md-6">
				{{ Form::label('name', 'Name:') }}
				{{ Form::text('name', null, ['class' => 'form-control'])  }}
				<br>
			</div>

			<div class="col-md-6">
				{{ Form::label('email', 'Email:') }}
				{{ Form::text('email', null, ['class' => 'form-control'])  }}
				<br>
			</div>

			<div class="col-md-12">
				{{ Form::label('comment', 'Comment:') }}
				{{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5'])  }}

				<br>
			</div>

			<div class="col-md-12">
				{{ Form::submit('Add Comment', ['class' => 'btn btn-block btn-success'])}}
				<br>
			</div>
		</div>


		{{ Form::close() }}
	</div>
</div>

<div class="row">
	<div class="col-md-8 col-md-offset-2">
	<h3 class="comments-title"><span class="glyphicon glyphicon-comments"></span> {{ $post->comments()->count()  }} &nbsp; Comments</h3>
		@foreach($post->comments as $comment)
			<div class="comment well">
				<div class="author-info">
					<img src="{{ "https://www.gravatar.com/avatar/".md5(strtolower(trim($comment->email))) }}" class="author-image">
					<div class="author-name">
						<h4>{{ $comment->name}}</h4>
						<p>{{ date( 'F nS, Y - g:iA' ,strtotime($comment-> created_at)) }}</p>
					</div>
				</div>
				<div class="comment-content">
					<p>{!! $comment->comment !!}</p>
				</div>
				<br>
			</div>
		@endforeach
	</div>
</div>

@endsection