<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Pricing;
use App\Models\ListingImages;
use App\Models\MasterKategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ListingController extends Controller
{
    public function index(){
        $listings = Listing::with('pricing')->with(['listingImages' => function ($query) {
            $query->paginate(10);
        }])->latest()->paginate(10);
        $kategori = MasterKategori::all();
        return view('listings.index', compact('listings', 'kategori'));
    }

    public function itemPage(Listing $listing){
       $listing->load('pricing', 'listingImages');
       return view('listings.item', compact('listing'));
    }

    public function postListing(Request $request){
        $validated = $request->validate([
            'nama_agunan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'kabupaten_kota' =>'required|string|max:255',
            'keterhunian' => 'required',
            'harga_jual' => 'required',
            'nilai_pasar' => 'required',
            'sisa_pokok' => 'required',
            'pola_penjualan' => 'required|string|max:255',
            'detail_agunan' => 'required',
            'id_kategori' => 'required'
        ]);

        DB::BeginTransaction();
        try{
            $listing = Listing::create([
                'nama_agunan' => $validated['nama_agunan'],
                'alamat' => $validated['alamat'],
                'kecamatan' => $validated['kecamatan'],
                'kelurahan' => $validated['kelurahan'],
                'kabupaten_kota' => $validated['kabupaten_kota'],
                'keterhunian' => $validated['keterhunian'],
                'detail_agunan' => $validated['detail_agunan'],
                'id_kategori' => $validated['id_kategori']
            ]);
            $listing->pricing()->create([
                'harga_jual' => $validated['harga_jual'] ?? 0,
                'nilai_pasar' => $validated['nilai_pasar'] ?? 0,
                'sisa_pokok' => $validated['sisa_pokok'] ?? 0,
                'bunga_denda' => $validated['bunga_denda'] ?? 0,
                'pola_penjualan' => $validated['pola_penjualan'] ?? 'tidak diinput'
            ]);
             // Handle image uploads
            if ($request->hasFile('images')) {
                $i = 0;
                foreach ($request->file('images') as $image) {
                    // Store each image and save its path
                    $filename = date('YmdHis').substr($validated['nama_agunan'],0,2).$i.'.'.$image->getClientOriginalExtension();
                    $image->storeAs('public/images/listing', $filename);
                    // Optionally, store the path in your database related to the post
                    $listing->listingImages()->create([
                        'filename' => $filename,
                        'filepath' => 'public/images/listing'
                    ]);
                    $i++;
                }
            }
            DB::commit();
            return redirect()->route('dashboard')->with('success', 'Post created successfully.');
        } catch (\Exception $e){
            DB::rollBack();
            Session::flash('error', 'Something went wrong: ' . $e->getMessage());
            return $e->getMessage();
        }
    }

    public function destroyListing($id){
        try {
            DB::beginTransaction();
    
            $listing = Listing::findOrFail($id);
            $listing = Listing::with('listingImages')->findOrFail($id);

            // Delete images from storage
            foreach ($listing->listingImages as $image) {
                $imagePath = 'public/images/listing/'.$image->filename;
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
            }
            
            // Optional: delete related pricing/images if necessary
            $listing->pricing()->delete();
            $listing->listingImages()->delete();
    
            $listing->delete();
    
            DB::commit();
            return redirect()->route('dashboard.index')->with('success', 'Listing deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete listing: ' . $e->getMessage());
        }
    }

    public function editListing(Request $request, $id){
        $validated = $request->validate([
            'nama_agunan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'kabupaten_kota' =>'required|string|max:255',
            'keterhunian' => 'required',
            'harga_jual' => 'required',
            'nilai_pasar' => 'required',
            'sisa_pokok' => 'required',
            'pola_penjualan' => 'required|string|max:255',
            'detail_agunan' => 'required'
        ]);

        DB::BeginTransaction();
        try{
            $listing = Listing::findOrFail($id);
            $listing->update([
                'nama_agunan' => $validated['nama_agunan'],
                'alamat' => $validated['alamat'],
                'kecamatan' => $validated['kecamatan'],
                'kelurahan' => $validated['kelurahan'],
                'kabupaten_kota' => $validated['kabupaten_kota'],
                'keterhunian' => $validated['keterhunian'],
                'detail_agunan' => $validated['detail_agunan']
            ]);
            if($listing->pricing){
                $listing->pricing()->update([
                    'harga_jual' => $validated['harga_jual'] ?? 0,
                    'nilai_pasar' => $validated['nilai_pasar'] ?? 0,
                    'sisa_pokok' => $validated['sisa_pokok'] ?? 0,
                    'bunga_denda' => $validated['bunga_denda'] ?? 0,
                    'pola_penjualan' => $validated['pola_penjualan'] ?? 'tidak diinput'
                ]);
            }
             // Handle image uploads
            if ($request->hasFile('images')) {
                $i = 0;
                foreach ($request->file('images') as $image) {
                    // Store each image and save its path
                    $filename = date('YmdHis').substr($validated['nama_agunan'],0,2).$i.'.'.$image->getClientOriginalExtension();
                    $image->storeAs('public/images/listing', $filename);
                    // Optionally, store the path in your database related to the post
                    $listing->listingImages()->create([
                        'filename' => $filename,
                        'filepath' => 'public/images/listing'
                    ]);
                    $i++;
                }
            }
            DB::commit();
            return redirect()->route('dashboard')->with('success', 'Post created successfully.');
        } catch (\Exception $e){
            DB::rollBack();
            Session::flash('error', 'Something went wrong: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
