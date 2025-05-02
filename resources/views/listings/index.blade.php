@extends('layouts.app')

@section('title', 'Katalog Aset Potensial | Jamkrindo Kanwil IX Makassar')

@section('content')
<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
          <div class="col-md-3 mb-4 border" style="padding-top: 20px;padding:30px;">
            <h4>Urutkan</h4>
            <form method="post" action="" enctype="multipart/form-data">
                  <label for="floatingInput">Berdasarkan</label>
                  <select class="form-control" name="keterhunian">
                    <option value="0" selected>Listing terbaru</option>
                    <option value="1">Listing terlama</option>
                    <option value="1">Harga tertinggi</option>
                    <option value="1">Harga terendah</option>
                </select>
            </form>
            <h4 class="mt-4">Filter</h4>
            <form method="post" action="" enctype="multipart/form-data">
                  <label for="floatingInput">Kabupaten/Kota</label>
                  <input class="form-control" type="text" name="kabupaten_kota">
                  <label for="floatingInput" style="margin-top:10px;">Harga minimal</label>
                  <input class="form-control" type="number" name="nilai_pasar" placeholder="Rp.">
                  <label for="floatingInput" style="margin-top:10px;">Harga maksimal</label>
                  <input class="form-control" type="number" name="nilai_pasar" placeholder="Rp.">
                  <label for="floatingInput" style="margin-top:10px;">Kategori</label>
                  <div class="row">
                  @foreach($kategori as $kateg)
                  <div class="col-md-6">
                    <input class="form-check-input" type="checkbox" name="kategori[]" value="{{$kateg->id}}">
                    <label class="form-check-label">{{$kateg->kategori}}</label>
                  </div>
                  @endforeach
                  </div>
                  <button type="submit" class="btn btn-primary w-100" style="margin-top:10px;">Terapkan</button>
            </form>
          </div>
          <div class="col-md-9 mb-4">
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
            </div>
        </div>
        <!-- Pagination -->
      <div class="d-flex justify-content-center mt-4">
            {{ $listings->links() }} <!-- Display pagination links -->
      </div>
    </div>
</section>
@endsection