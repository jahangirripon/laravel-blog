@extends('main')

@section('title', '| All Categories')

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1>Tags</h1>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
					</tr>
					<tbody>
						@foreach ($tags as $tag)
						<tr>
							<td> {{ $tag-> id }}</td>
							<td> {{ $tag->name }}</td>
						</tr>

						@endforeach
					</tbody>
				</thead>
			</table>
		</div>
		<div class="col-md-4">
			<div class="well">
				{!! Form::open(['route' => 'tags.store', 'mathod' => 'POST' ])  !!}

				<h2>Add Tag</h2>
				{{ Form::label('name', 'Name:')}}
				{{ Form::text('name', null, ['class' =>' form-control'])}}
				<br>

				{{ Form::submit('Add tag', ['class' => 'btn btn-block btn-success'])}}


				{!! Form::close() !!}
			</div>
		</div>
	</div>

@endsection