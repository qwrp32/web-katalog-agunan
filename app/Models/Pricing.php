<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['harga_jual', 'nilai_pasar', 'sisa_pokok', 'bunga_denda', 'pola_penjualan'];

    public function listing(){
        return $this->belongsTo(Listing::class, 'listings_id', 'id');
    }
}
