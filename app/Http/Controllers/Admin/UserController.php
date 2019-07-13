<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;

class UserController extends Controller
{
	/**
	 * Show the index of users.
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function index()
    {
    	$data['users'] = User::orderBy('last_name')->get();

    	return view('admin.users.index', $data);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return $this->edit(new User());
    }

    /**
     * Store a newly created user.
     *
     * @param  \Illuminate\Http\Request $request [description]
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	return $this->update($request, new User());
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  App\Models\User   $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
    	$this->authorize('update', $user);

    	$data['user'] = $user;

    	return view('admin.users.edit', $data);
    }

    /**
     * Update the user in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\User    		$user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
    	$this->authorize('update', $user);

        $rules = [
            'first_name' => 'required|max:255|string',
            'last_name' => 'required|max:255|string',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ];

        if ($user->id) {
            $rules['password'] = 'nullable|min:6|confirmed';
        } else {
            $rules['password'] = 'required|min:6|confirmed';
        }

    	$this->validate($request, $rules);

    	$user->first_name = $request->input('first_name');
    	$user->last_name = $request->input('last_name');
    	$user->email = $request->input('email');

    	if ($request->filled('password')) $user->password = bcrypt($request->input('password'));

    	$saved = $user->save();

    	if ($saved) {
    		return redirect(route('admin.users.edit', $user))->with('success', 'User was saved.');
    	} else {
    		return redirect(route('admin.users.edit', $user))->with('danger', 'Something went wrong.');
    	}
    }

    /**
     * Destroy the specified user.
     *
     * @param  \App\Models\User   $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
    	$this->authorize('destroy', $user);

    	if ($user->delete()) {
    		return redirect(route('admin.users.index'))->with('success', 'User was deleted.');
    	} else {
    		return redirect(route('admin.users.index'))->with('danger', 'Something went wrong.');
    	}
    }
}
