<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	/**
	 * Return the images that have this category.
	 * 
	 * @return \Illuminate\Eloquent\Database\HasMany
	 */
    public function images()
    {
    	return $this->hasMany(Image::class);
    }
}
