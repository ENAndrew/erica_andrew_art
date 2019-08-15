<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageType extends Model
{
	/**
	 * Return the images that have this type.
	 *
	 * @return \Illuminate\Eloquent\Database\HasMany
	 */
    public function images()
    {
    	return $this->hasMany(Image::class, 'type_id');
    }
}
