<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingImages extends Model
{
    use HasFactory;

    protected $fillable = ['listings_id', 'filename', 'filepath'];

    public function listing(){
        return $this->belongsTo(Listing::class, 'listings_id', 'id');
    }
}
