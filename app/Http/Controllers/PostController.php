<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;

use DB;

class PostController extends Controller
{
    public function add()
    {
    	$cats = Category::all();
    	return view('admin.post.add', compact('cats'));
    }

    public function store(Request $request)
    {
    	$request->validate([
    		'category' => 'required',
    		'title' => 'required',
    		'content' => 'required',
    	]);

    	$post = new Post;
    	$post->title = $request->input('title');
    	$post->slug = str_replace(" ", '-', $request->input('title'));
    	$post->content = $request->input('content');

    	$f = Post::where('title', '=', $request->input('title'))->get()->count();
        if (Post::where('title', '=', $request->input('title'))->exists())
        {
            $post->slug = str_replace([" ", "/"], '-', $post->title) . '-' . $f;
        }

    	$post->save();

    	$post->category()->attach($request->input('category'));
    	return redirect()->back()->with('status', 'new post added!');
    }

    public function index()
    {
    	$posts = Post::all();
    	return view('admin.post.index', compact('posts'));
    }

    public function detail($slug)
    {
        $post = Post::where('slug', '=', $slug)->first();
        return view('admin.post.detail', compact('post'));
    }

    public function edit($id)
    {
    	$cats = DB::table('categories')->pluck("name","id");
    	$post = Post::where('id', $id)->first();
    	$selectedCat = [];
        foreach ($post->category()->get() as $f)
        {
            $selectedCat[] = $f->name;
        }
    	return view('admin.post.edit', compact('post', 'cats', 'selectedCat'));
    }

    public function update(Request $request, $id)
    {
    	$post = Post::where('id', $id)->update([
    		'title' => $request->input('title'),
    		'slug' => str_replace(" ", '-', $request->input('title')),
    		'content' => $request->input('content'),

    	]);

    	$p = Post::find($id);
    	$p->category()->sync($request->input('category'));
    	return redirect('/blog');
    }

    public function destroy($id)
    {
    	Post::where('id', $id)->delete();
    	return redirect()->back();
    }
}
