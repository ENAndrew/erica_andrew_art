<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ImageType;

class ImageTypeController extends Controller
{
	/**
	 * Show a listing of image types.
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function index()
    {
    	$data['types'] = ImageType::orderBy('name')->get();

    	return view('admin.imagetypes.index', $data);
    }

    /**
     * Create a new image type.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return $this->edit(new ImageType());
    }

    /**
     * Store a newly created image type.
     *
     * @param  \Illuminate\Https\Request $request
     * @return \Illuminate\Https\Response
     */
    public function store(Request $request)
    {
    	return $this->update($request, new ImageType());
    }

    /**
     * Show the form for editing or creating an image type.
     *
     * @param  \App\Models\ImageType $imageType
     * @return \Illuminate\Http\Response
     */
    public function edit(ImageType $imageType)
    {
    	$this->authorize('update', $imageType);

    	$data['type'] = $imageType;

    	return view('admin.imagetypes.edit', $data);
    }

    /**
     * Update an image type in storage.
     *
     * @param  \Illuminate\Http\Request   $request
     * @param  \App\Models\ImageType $imageType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImageType $imageType)
    {
    	$this->authorize('update', $imageType);

    	$this->validate($request, [
    		'name' => 'required|string|max:255',
    		'slug' => 'required|string|unique:image_types,slug,' . $imageType->id,
    	]);

    	$imageType->name = $request->input('name');
    	$imageType->slug = $request->input('slug');

    	if ($imageType->save()) {
    		return redirect(route('admin.imagetypes.edit', $imageType))->with('success', 'Image type has been saved.');
    	} else {
    		return redirect(route('admin.imagetypes.edit', $imageType))->with('danger', 'Something went wrong, please try again.');
    	}
    }

    /**
     * Destroy the specified image type.
     *
     * @param  \App\Models\ImageType $imageType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImageType $imageType)
    {
    	$this->authorize('destroy', $imageType);

    	if ($imageType->images()->count()) {
    		return redirect(route('admin.imagetypes.index'))->with('danger', $imageType->images()->count() . ' image(s) are attached to this type, change the image types first.');
    	}

    	if ($imageType->delete()) {
    		return redirect(route('admin.imagetypes.index'))->with('success', 'Image type was deleted.');
    	} else {
    		return redirect(route('admin.imagetypes.index'))->with('danger', 'Something went wrong, please try again.');
    	}
    }
}
