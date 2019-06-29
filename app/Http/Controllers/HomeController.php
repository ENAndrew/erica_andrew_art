<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['pageTitle'] = 'Erica Andrew Art';

        return view('home', $data);
    }

    /**
     * Show the traditional art gallery.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function traditional()
    {
        $data['pageTitle'] = 'Traditional | Erica Andrew Art';

        return view('traditional', $data);
    }

    /**
     * Show the ditigal art gallery.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function digital()
    {
        $data['pageTitle'] = 'Digital | Erica Andrew Art';

        return view('digital', $data);
    }

    /**
     * Show the design page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function design()
    {
        $data['pageTitle'] = 'Design | Erica Andrew Art';

        return view('design', $data);
    }

    /**
     * Show the contact page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contact()
    {
        $data['pageTitle'] = 'Contact | Erica Andrew Art';

        return view('contact', $data);
    }
}
