<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Image;
use App\Models\ImageType;

class ImageController extends Controller
{
	/**
	 * Show the index of images
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function index()
    {
    	$data['images'] = Image::with('type')->orderBy('sort_order')->get();
    	$data['types'] = ImageType::all();

    	return view('admin.images.index', $data);
    }
}
