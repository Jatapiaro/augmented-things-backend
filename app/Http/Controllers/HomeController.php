<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        /*\JavaScript::put([
            'user' => json_encode(new UserResource(Auth::user())),
            'routes' => json_encode($routes),
            'baseUrl' => config('app.url')
		]);*/
        return view('home');
    }
}
