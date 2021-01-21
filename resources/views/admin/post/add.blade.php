@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card">
		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif

		@if (session('status'))
		    <div class="alert alert-success">
		        {{ session('status') }}
		    </div>
		@endif

		</ul>
		<form action="{{ route('blog.store') }}" method="post" style="margin: 1rem;">
			@csrf
			<label for="name">category :</label>
			<select class="js-example-basic-multiple form-control" name="category[]" multiple="multiple">
				@foreach($cats as $cat)
				<option value="{{ $cat->id }}">{{ $cat->name }}</option>
				@endforeach
			</select>
			<label for="name">title :</label>
			<input type="text" class="form-control" name="title" required>
			<label for="content">content :</label>
			<textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
			<input type="submit" class="btn btn-primary" style="margin-top: .5rem;">
			<br>
			<a href="/blog">&larr; back to post list</a>
		</form>
	</div>
</div>
@endsection