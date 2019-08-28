<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Events\ImageDeleting;

class Image extends Model
{
	/**
	 * The event map for the model.
	 *
	 * @var [type]
	 */
	protected $dispatchesEvents = [
		'deleting' => ImageDeleting::class,
	];

	/**
	 * Return the category this image belongs to.
	 *
	 * @return \Illuminate\Eloquent\Database\BelongsTo
	 */
    public function type()
    {
    	return $this->belongsTo(ImageType::class, 'type_id');
    }
}
