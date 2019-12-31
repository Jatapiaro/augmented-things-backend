<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Resources
use App\Http\Resources\User as UserResource;
use Auth;

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
        \JavaScript::put([
            'user' => new UserResource(Auth::user()),
            'baseUrl' => config('app.url')
		]);
        return view('home');
    }
}
