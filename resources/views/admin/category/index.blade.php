@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card">
		@role('Admin')
			<a href="/admin/category/add" class="btn btn-info" style=" margin: .5rem; width: 11rem;">add new category</a>
		@endrole
		<table class="table">
			<thead>
				<tr>
					<th scope="col">category name</th>
					<th scope="col">detail</th>
					@role('Admin')
						<th scope="col">edit</th>
						<th scope="col">delete</th>
					@endrole
				</tr>
			</thead>
			<tbody>
				@foreach($cats as $cat)
				<tr>
					<td>{{ $cat->name }}</td>
					<td><a href="/category/{{ $cat->slug }}" class="btn btn-secondary">detail</a></td>
					@role('Admin')
						<td><a href="/admin/category/{{ $cat->id }}/edit" class="btn btn-warning">edit</a></td>
						<td>
							<form action="{{ url('/admin/category/' . $cat->id . '/delete') }}" method="post">
	                            @method('DELETE')
	                            @csrf
	                            <button type="submit" class="btn btn-danger">delete</button>
	                        </form>
						</td>
					@endrole
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection