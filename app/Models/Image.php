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
    public function category()
    {
    	return $this->belongsTo(Category::class);
    }
}
