<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactEmail;

use App\Rules\Captcha;

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
        $data['metaKeywords'] = 'art artist digital traditional design development web painting drawing tattoo';
        $data['metaDescription'] = 'Erica Andrew\'s Art and Web Development';

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
        $data['metaKeywords'] = 'art traditional drawing painting watercolor tattoo design';
        $data['metaDescription'] = 'Erica Andrew\'s Traditional Media Artwork';

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
        $data['metaKeywords'] = 'art artist digital painting tattoo design';
        $data['metaDescription'] = 'Erica Andrew\'s Digital Media Artwork';

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
        $data['metaKeywords'] = 'web development design portfolio';
        $data['metaDescription'] = 'Erica Andrew\'s Web Development Portfolio';

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
        $data['metaKeywords'] = 'contact email';
        $data['metaDescription'] = 'Contact me for art or design commissions.';

        return view('contact', $data);
    }

    /**
     * Process the contact form.
     *
     * @param  \Iluminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function processContact(Request $request)
    {
        $mailTo = 'erica.nicole.andrew@gmail.com';

        $data = new \stdClass();

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ];

        $rules['g-recaptcha-response'] = new Captcha();

        $this->validate($request, $rules);

        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->message = $request->input('message');

        Mail::to($mailTo)->send(new ContactEmail($data));

        return view('thanks');
    }
}
