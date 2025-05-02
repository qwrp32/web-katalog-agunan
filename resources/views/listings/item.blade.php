@extends('layouts.app')

@section('title', 'Katalog Aset Potensial | Jamkrindo Kanwil IX Makassar')

@section('content')
<!-- Features Section -->
<div class="container">
<a href="{{ route('listings') }}" class="btn btn-link btn-md">< Kembali</a>
    <h1>{{ $listing->nama_agunan }}</h1>
        <div class="row" style="margin-top:20px;margin-bottom:30px;">
            <div class="col-md-7">
                @if ($listing->listingImages->isNotEmpty())
                    <div id="listingImageCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($listing->listingImages as $key => $image)
                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/images/listing/'.$image->filename) }}" class="d-block w-100 fixed-height-image" alt="{{ $listing->name }} - Image {{ $key + 1 }}">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#listingImageCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#listingImageCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                    {{-- Thumbnails below the carousel --}}
                    <div class="row mt-3">
                        @foreach ($listing->listingImages as $key => $image)
                            <div class="col-3 col-md-2">
                                <img src="{{ asset('storage/images/listing/'.$image->filename) }}" class="img-thumbnail" style="cursor: pointer;" alt="{{ $listing->name }} - Thumbnail {{ $key + 1 }}"
                                     onclick="document.querySelector('#listingImageCarousel').carousel({{ $key }})">
                            </div>
                        @endforeach
                    </div>
                @else
                    <img src="{{ asset('images/thumbnail.png') }}" class="d-block w-100 fixed-height-image" alt="thumbnail">
                @endif
            </div>
            <div class="col-md-5 p-4 border">
                <h1>{{ 'Rp. ' . number_format($listing->pricing->harga_jual, 0, ',', '.') }}</h1>
                {{-- Other listing details --}}
                <p style="font-size:20px;">{{$listing->nama_agunan}}</p>
                <p style="font-size:16px;">
                    {{$listing->alamat}}<br/>
                    Kecamatan: {{$listing->kecamatan}}<br/>
                    Kabupaten/Kota: {{$listing->kabupaten_kota}}</br>
                    Keterhunian: 
                    @if ($listing->keterhunian == 0)
                        Tidak dihuni
                    @else
                        Dihuni
                    @endif
                </p>
                <p>
                {!! nl2br(e($listing->detail_agunan)) !!}
                </p>
            </div>
        </div>
    </div>

    <style>
        .fixed-height-image {
            object-fit: cover; /* Crop to fill */
            height: 500px; /* Set your desired fixed height */
            width: 100%; /* Ensure it fills the carousel width */
        }

        .img-thumbnail {
            max-width: 100%;
            height: auto;
            border: 1px solid #dee2e6;
            padding: 0.25rem;
            background-color: #f8f9fa;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carouselElement = document.querySelector('#listingImageCarousel');
            const thumbnails = document.querySelectorAll('.img-thumbnail');
            const carousel = new bootstrap.Carousel(carouselElement);

            thumbnails.forEach((thumbnail, index) => {
                thumbnail.addEventListener('click', () => {
                    carousel.to(index);
                });
            });

            carouselElement.addEventListener('slid.bs.carousel', event => {
                thumbnails.forEach(thumbnail => thumbnail.classList.remove('active'));
                thumbnails[event.to].classList.add('active');
            });

            if (thumbnails.length > 0) {
                thumbnails[0].classList.add('active');
            }
        });
    </script>
@endsection
