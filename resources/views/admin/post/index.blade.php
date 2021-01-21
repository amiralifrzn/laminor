@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card">
		@role('Admin')
			<a href="/admin/blog/add" class="btn btn-info" style=" margin: .5rem; width: 11rem;">add new post</a>
		@endrole
		<table class="table">
			<thead>
				<tr>
					<th scope="col">post category</th>
					<th scope="col">post title</th>
					<th scope="col">post content</th>
					<th scope="col">detail</th>
					@role('Admin')
						<th scope="col">edit</th>
						<th scope="col">delete</th>
					@endrole
				</tr>
			</thead>
			<tbody>
				@foreach($posts as $post)
				<tr>
					<td>
						@foreach($post->category as $cat)
						<ul>
							<li>{{ $cat->name }}</li>
						</ul>
						@endforeach
					</td>
					<td>{{ mb_strimwidth($post->title, 0, 30, "...") }}</td>
					<td>{{ mb_strimwidth($post->content, 0, 70, "...") }}</td>
					<td><a href="/blog/{{ $post->slug }}" class="btn btn-secondary">detail</a></td>
					@role('Admin')
						<td><a href="/admin/blog/{{ $post->id }}/edit" class="btn btn-warning">edit</a></td>
						<td>
							<form action="{{ url('/admin/blog/' . $post->id . '/delete') }}" method="post">
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