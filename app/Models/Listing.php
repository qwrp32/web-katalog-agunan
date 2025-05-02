<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['nama_agunan', 'detail_agunan', 'alamat', 'kelurahan', 'kecamatan', 'kabupaten_kota', 'keterhunian', 'contact_list', 'id_kategori'];

    public function pricing(){
        return $this->hasOne(Pricing::class, 'listings_id', 'id');
    }

    public function listingImages(){
        return $this->hasMany(ListingImages::class, 'listings_id', 'id');
    }
}
