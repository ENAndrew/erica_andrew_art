<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use Auth;

use App\Models\Category;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Allow logged-in users to update users.
     * 
     * @param  App\Models\User   $user   
     * @param  App\Models\Category   $category 
     * @return boolean
     */
    public function update(User $user, Category $category)
    {
        return $user === Auth::user();
    }

    /**
     * Allow logged-in users to delete users.
     * 
     * @param  App\Models\User   $user   
     * @param  App\Models\Category   $category 
     * @return boolean
     */
    public function destroy(User $user, Category $category)
    {
        return $user === Auth::user();
    }
}
