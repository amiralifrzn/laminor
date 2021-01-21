<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function add()
    {
    	return view('admin.category.add');
    }

    public function store(Request $request)
    {
    	$request->validate([
    		'category_name' => 'required',
    	]);

    	$cat = new Category();
    	$cat->name = $request->input('category_name');
    	$cat->slug = str_replace(" ", '-', $request->input('category_name'));
    	 if (Category::where('name', $request->get('category_name'))->exists()) {
            return redirect()->back()->with('status', 'Duplicate record');
        }
    	$cat->save();
    	return redirect()->back()->with('status', 'new category added!');
    }

    public function index()
    {
    	$cats = Category::all();
    	return view('admin.category.index', compact('cats'));
    }

    public function detail($slug)
    {
        $cat = Category::where('slug', '=', $slug)->first();
        return view('admin.category.detail', compact('cat'));
    }

    public function edit($id)
    {
    	$cat = Category::where('id', $id)->first();
    	return view('admin.category.edit', compact('cat'));
    }

    public function update(Request $request, $id)
    {
    	$cat = Category::where('id', $id)->update([
            'name' => $request->input('category_name'),
            'slug' => str_replace(" ", '-', $request->input('category_name')),
        ]);
    	return redirect('/category');
    }

    public function destroy($id)
    {
    	Category::where('id', $id)->delete();
    	return redirect()->back();
    }
}
