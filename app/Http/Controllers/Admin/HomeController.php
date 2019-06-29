<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	/**
	 * Show the admin dashboard
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function dashboard()
    {
    	return view('admin.dashboard');
    }
}
