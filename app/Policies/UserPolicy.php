<?php

namespace App\Policies;

use Auth;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Allow logged-in users to update users.
     * 
     * @param  App\Models\User   $user   
     * @param  App\Models\User   $subject 
     * @return boolean
     */
    public function update(User $user, User $subject)
    {
        return $user === Auth::user();
    }

    /**
     * Allow logged-in users to delete users.
     * 
     * @param  App\Models\User   $user   
     * @param  App\Models\User   $subject 
     * @return boolean
     */
    public function destroy(User $user, User $subject)
    {
        return $user === Auth::user();
    }
}
