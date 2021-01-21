@extends('layouts.app')

@section('content')
<style>
    .display-comment .display-comment {
        margin-left: 40px
    }
</style>

<div class="container">
	<div class="card" style="padding: 2.5rem";>
		<a href="/blog">&larr; back to list</a>
		<label for="">category: </label> 
		<ul>
			@foreach($post->category as $cat)
				<li>{{ $cat->name }}</li>
			@endforeach
		</ul>
		<label for="">title: </label> 
		<h2>{{ $post->title }}</h2>
		<label for="">content: </label> 
		<h2>{{ $post->content }}</h2>
		<hr>
		<h5>Display Comments</h5>

	    @include('admin.post.reply', ['comments' => $post->comments, 'post_id' => $post->id])

	    <hr />
	   </div>

	   <div class="card">
	    <h5>Leave a comment</h5>
	    <form method="post" action="{{ route('comment.add') }}">
	        @csrf
	        <div class="form-group">
	            <input type="text" name="comment" class="form-control" required />
	            <input type="hidden" name="post_id" value="{{ $post->id }}" />
	        </div>
	        <div class="form-group">
	            <input type="submit" class="btn btn-sm btn-outline-danger py-2" style="font-size: 0.8em;" value="Add Comment" />
	        </div>
	    </form>
	   </div>
	</div>
</div>
    
@endsection