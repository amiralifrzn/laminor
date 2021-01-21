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
		<form action="/admin/category/{{ $cat->id }}/update" method="post" style="margin: 1rem;">
			@csrf
			<label for="name">Category Name :</label>
			<input type="text" class="form-control" name="category_name" value="{{ $cat->name }}" required>
			<input type="submit" class="btn btn-primary" style="margin-top: .5rem;">
			<br>
			<a href="/category">&larr; back to category list</a>
		</form>
	</div>
</div>
@endsection