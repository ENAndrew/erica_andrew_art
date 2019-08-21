<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Image as ImageModel;
use App\Models\ImageType;

use Image;
use Storage;

class ImageController extends Controller
{
	/**
	 * Show the index of images
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function index()
    {
    	$data['images'] = ImageModel::with('type')->orderBy('sort_order')->get();
    	$data['types'] = ImageType::all();

    	return view('admin.images.index', $data);
    }

    /**
     * Store a newly created image and thumbnail image.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('update', new ImageModel());

        $this->validate($request, [
            'images' => 'required|array',
            'images.*' => 'required|image|max:2500000',
            'type' => 'required|exists:image_types,name',
        ]);

        $maxWidth = 1920;
        $maxHeight = 1080;

        $thumbnailWidth = 480;

        foreach ($request->file('images') as $file) {
            $image = Image::make($file->getRealPath());

            list($origWidth, $origHeight) = getimagesize($file);

            $thumbnailHeight = ceil($origHeight * ($thumbnailWidth / $origWidth));

            // This works to here
        }

    }
}
