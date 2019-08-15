<?php

namespace App\Policies;

use Auth;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\ImageType;

class ImageTypePolicy
{
    use HandlesAuthorization;

    /**
     * Allow logged-in users to update image types.
     *
     * @param  App\Models\User   $user
     * @param  App\Models\ImageType   $imageType
     * @return boolean
     */
    public function update(User $user, ImageType $imageType)
    {
        return $user === Auth::user();
    }

    /**
     * Allow logged-in users to delete image types.
     *
     * @param  App\Models\User   $user
     * @param  App\Models\ImageType   $imageType
     * @return boolean
     */
    public function destroy(User $user, ImageType $imageType)
    {
        return $user === Auth::user();
    }
}
