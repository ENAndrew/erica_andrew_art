<?php

namespace App\Policies;

use Auth;

use App\Models\Image;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ImagePolicy
{
    use HandlesAuthorization;

    /**
     * Allow logged-in users to update images.
     *
     * @param  App\Models\User   $user
     * @param  App\Models\Image   $image
     * @return boolean
     */
    public function update(User $user, Image $image)
    {
        return $user === Auth::user();
    }

    /**
     * Allow logged-in users to delete images.
     *
     * @param  App\Models\User   $user
     * @param  App\Models\Image   $image
     * @return boolean
     */
    public function destroy(User $user, Image $image)
    {
        return $user === Auth::user();
    }
}
