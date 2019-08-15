<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
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
