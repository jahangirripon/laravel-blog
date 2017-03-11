@extends('main')

@section('title', '| Delete Comment')

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h2>Want to delete this content?</h2>

			<p>
				<strong>Name:</strong>{{ $comment->name }}<br>
				<strong>Email:</strong>{{ $comment->email }}<br>
				<strong>Comment:</strong>{{ $comment->comment }}
			</p>

			{{ Form::open(['route'=>['comments.destroy', $comment->id],'method'=> 'Delete']) }}
				{{ Form::submit('Delete', ['class' => 'btn btn-lg btn-block'])}}
			{{ Form::close() }}
		</div>
	</div>

@endsection