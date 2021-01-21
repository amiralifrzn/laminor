@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card" style="padding: 2.5rem";>
		<a href="/category">&larr; back to list</a>
		<label for="">category name: </label> 
		<h2>{{ $cat->name }}</h2>
	</div>
</div>
@endsection