@extends('layouts.app')

@section('title', 'Katalog Aset Potensial | Jamkrindo Kanwil IX Makassar')

@section('content')

<!-- Hero Section -->
<section class="hero-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-7">
        <h1 class="hero-title"><strong>Selamat Datang</strong></h1>
        <p class="hero-description"><strong>Di katalog aset potensial recovery Jamkrindo Kanwil IX Makassar.</strong></p>
        <!--a href="#" class="btn btn-primary btn-lg">Lihat Listing</a-->
      </div>
      <div class="col-md-5 text-right">
        <img src="{{ asset('images/upper-hero.webp') }}" style="height:350px;">
      </div>
    </div>
  </div>
</section>

<!-- Features Section -->
<section id="features" class="pt-3 bg-white">
    <div class="container">
        <h2 class="section-title text-center mb-3">Listing Terbaru</h2>
        <div class="row">
            @foreach($listings as $listing)
            <div class="col-md-4 mb-4">
                <div class="card equal-height-card">
                @if ($listing->listingImages->isNotEmpty())
                    @php
                        $firstImage = $listing->listingImages->first();
                    @endphp
                    @if ($firstImage)
                    <img src="{{ asset('storage/images/listing/'.$firstImage->filename) }}" alt="thumbnail" class="card-img-top" style="height: 250px;">
                    @else
                    <img src="{{ asset('images/thumbnail.png') }}" alt="thumbnail" class="card-img-top" style="height: 250px;"/>
                    @endif
                @else
                    <img src="{{ asset('images/thumbnail.png') }}" alt="thumbnail" class="card-img-top" style="height: 250px;"/>
                @endif
                  <div class="card-body">
                    <h4 class="card-title">{{ 'Rp. ' . number_format($listing->pricing->harga_jual, 0, ',', '.') }}</h4>
                    <p class="card-text">
                      {{$listing->nama_agunan}}. 
                      {{$listing->alamat.', '.$listing->kecamatan}}
                    </p>
                    <a href="{{ route('listings.item', $listing->id) }}" class="btn btn-success">Lihat detail ></a>
                  </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
        <div class="col mb-4 text-center"><a href="{{ route('listings') }}" class="btn btn-primary btn-lg" style="width: 200px;">Lihat semua</a></div>
        </div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.equal-height-card');
        let maxHeight = 0;

        cards.forEach(card => {
            maxHeight = Math.max(maxHeight, card.offsetHeight);
        });

        cards.forEach(card => {
            card.style.height = maxHeight + 'px';
        });
    });
</script>
@endsection