<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Category;

class CategoryController extends Controller
{
	/**
	 * Show a listing of image categories.
	 * 
	 * @return \Illuminate\Http\Response
	 */
    public function index()
    {
    	$data['categories'] = Category::orderBy('name')->get();

    	return view('admin.categories.index', $data);
    }

    /**
     * Create a new category.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->edit(new Category());
    }

    /**
     * Store a newly created category.
     * 
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
    	return $this->update($request, new Category());
    }

    /**
     * Show the form for editing or creating a category.
     * 
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
    	$this->authorize('update', $category);

    	$data['category'] = $category;

    	return view('admin.categories.edit', $data);
    }

    /**
     * Update a category in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category 	 $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
    	$this->authorize('update', $category);

    	$this->validate($request, [
    		'name' => 'required|string|max:255',
    		'slug' => 'required|string|unique:categories,slug,' . $category->id,
    	]);

    	$category->name = $request->input('name');
    	$category->slug = $request->input('slug');

    	if ($category->save()) {
    		return redirect(route('admin.categories.edit', $category))->with('success', 'Category has been saved.');
    	} else {
    		return redirect(route('admin.categories.edit', $category))->with('danger', 'Something went wrong, please try again.');
    	}
    }

    /**
     * Destroy the specified category. 
     * 
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category) 
    {
    	$this->authorize('destroy', $category);

    	if ($category->images()->count()) {
    		return redirect(route('admin.categories.index'))->with('danger', $category->images()->count() . ' image(s) are attached to this category, change the image categories first.');
    	}

    	if ($category->delete()) {
    		return redirect(route('admin.categories.index'))->with('success', 'Category was deleted.');
    	} else {
    		return redirect(route('admin.categories.index'))->with('danger', 'Something went wrong, please try again.');
    	}
    }
}
