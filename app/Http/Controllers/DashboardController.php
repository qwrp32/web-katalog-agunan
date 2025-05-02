<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Listing;
use App\Models\MasterKategori;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // Show dashboard view
    public function index()
    {
        $user = Auth::user();
        $listings = Listing::with('pricing')->latest()->paginate(10);
        return view('dashboard.index', compact('user', 'listings'));
    }

    public function newListing(){
        $kategori = MasterKategori::all();
        return view('dashboard.create', compact('kategori'));
    }

    public function editListing(Listing $listing){
        $listing->load('pricing', 'listingImages');
       return view('dashboard.edit', compact('listing'));
    }
}
