<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $listings = Listing::with('pricing')->with(['listingImages' => function ($query) {
            $query->limit(6);
        }])->limit(6)->latest()->get();
        return view('home', compact('listings'));
    }
}
