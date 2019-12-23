<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\File;
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

            $image->resize($maxWidth, $maxHeight, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $hash = $file->hashName();
            $temporaryPath = "/tmp/{$hash}.png";
            $image->save($temporaryPath);
            $original = new File($temporaryPath);

            $thumbnail = Image::make($temporaryPath)->resize($thumbnailWidth, $thumbnailHeight);
            $temporaryThumbnailPath = "/tmp/{$hash}-thumbnail.png";
            $thumbnail->save($temporaryThumbnailPath);
            $thumb = new File($temporaryThumbnailPath);

            $newImage = new ImageModel();
            $newImage->type_id = ImageType::where('name', $request->input('type'))->value('id');
            $newImage->path = Storage::disk('s3')->putFile('images/originals', $original);
            $newImage->url = Storage::disk('s3')->url($newImage->path);
            $newImage->thumbnail_path = Storage::disk('s3')->putFile('images/thumbnails', $thumb);
            $newImage->thumbnail_url = Storage::disk('s3')->url($newImage->thumbnail_path);
            $newImage->save();
        }

        return redirect(route('admin.images.index'))->with('success', 'Images have been saved.');
    }

    /**
     * Update the description of the image in storage.
     *
     * @param  \Illuminate\Http\Request    $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $imageModel = ImageModel::where('id', $request->input('id'))->first();

        $this->authorize('update', $imageModel);

        $this->validate($request, [
            'description' => 'required|string',
        ]);

        $imageModel->description = $request->input('description');

        $saved = $imageModel->save();

        return response()->json([
            'status' => $saved ? 200 : 500,
            'message' => $saved ? 'Description has been saved.' : 'Description was not saved.',
            'description' => $saved ? $imageModel->description : ''
        ]);
    }

    /**
     * Destroy the given image.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $imageModel = ImageModel::where('id', $request->input('id'))->first();

        $this->authorize('destroy', $imageModel);

        $deleted = $imageModel->delete();

        return response()->json([
            'status' => $deleted ? 200 : 500,
            'message' => $deleted ? 'Image has been deleted.' : 'Image was not deleted.',
        ]);
    }

    /**
     * Update the order of images in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrder(Request $request)
    {
        $this->validate($request, [
            'images' => 'required|array',
            'images.*' => 'required|integer|exists:images,id',
        ]);

        foreach ($request->input('images') as $index => $id) {
            ImageModel::where('images.id', $id)->update([ 'sort_order' => $index ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Image order updated.',
        ]);
    }
}
