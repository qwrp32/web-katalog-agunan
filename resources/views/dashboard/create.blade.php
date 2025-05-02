@extends('layouts.dash')

@section('title', 'Listing Baru')
@section('content')
@if (Session::has('error'))
  <script>
    alert("{{ Session::get('error') }}");
  </script>
@endif
<div class="container">
  <h1>Tambah Listing Baru</h1>
  <section class="mt-3">
    <form method="post" action="{{ route('listing.postListing') }}" enctype="multipart/form-data">
      @csrf
      <!-- Error message when data is not inputted -->
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card p-3">
                <label for="floatingInput">Judul</label>
                <input class="form-control" type="text" name="nama_agunan">
                <label for="floatingInput">Alamat</label>
                <input class="form-control" type="text" name="alamat">
                <label for="floatingInput">Kecamatan</label>
                <input class="form-control" type="text" name="kecamatan">
                <label for="floatingInput">Kelurahan</label>
                <input class="form-control" type="text" name="kelurahan">
                <label for="floatingInput">Kabupaten/Kota</label>
                <input class="form-control" type="text" name="kabupaten_kota">
                <label for="floatingInput">Keterhunian (jika rumah/bangunan)</label>
                <select class="form-control" name="keterhunian">
                    <option value="0" selected>Tidak dihuni</option>
                    <option value="1">Dihuni</option>
                </select>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card p-3">
                <label for="floatingInput">Estimasi Harga jual</label>
                <input class="form-control" type="number" name="harga_jual">
                <label for="floatingInput">Perkiraan Nilai pasar</label>
                <input class="form-control" type="number" name="nilai_pasar">
                <label for="floatingInput">Sisa Pokok</label>
                <input class="form-control" type="number" name="sisa_pokok">
                <label for="floatingInput">Bunga & denda</label>
                <input class="form-control" type="number" name="bunga_denda">
                <label for="floatingInput">Pola penjualan (ex: Lelang harga tertinggi)</label>
                <input class="form-control" type="text" name="pola_penjualan">
                <label for="floatingInput">Kategori</label>
                <select class="form-control" name="id_kategori">
                @foreach ($kategori as $kateg)
                  <option value="{{$kateg->id}}" {{$kateg->id == 1 ? 'selected' : ''}}>{{$kateg->kategori}}</option>
                @endforeach
              </select>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card p-3">
                <label for="floatingTextArea">Detail deskripsi</label>
                <textarea class="form-control" name="detail_agunan" id="floatingTextarea" cols="30" rows="10"></textarea>
                    
                <!-- Multiple images input -->
                <label for="formFile" class="form-label">Tambah gambar agunan</label>
                <input class="form-control" type="file" name="images[]" id="images" multiple onchange="previewImages()">
                    
                <!-- Image previews -->
                <div id="imagePreviews" class="mt-3">
                <!-- Preview images will appear here -->
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col text-end">
            <a href="{{ route('dashboard') }}" class="btn btn-danger btn-lg">
                <i class="bi bi-plus-circle"></i>Batal
            </a>
            <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
        </div>
      </div>
    </form>
  </section>
</div>

<script>
  function previewImages() {
    const files = document.getElementById('images').files;
    const previewContainer = document.getElementById('imagePreviews');
    
    // Clear any previous previews
    previewContainer.innerHTML = '';

    // Loop through the selected files
    for (let i = 0; i < files.length; i++) {
      const file = files[i];
      
      // Create a new image element
      const img = document.createElement('img');
      img.classList.add('img-preview');
      img.style.maxWidth = '150px';
      img.style.marginRight = '10px';
      
      // Use FileReader to display the image
      const reader = new FileReader();
      reader.onload = function(e) {
        img.src = e.target.result; // Set the image source to the reader's result
        previewContainer.appendChild(img); // Add the image to the preview container
      };
      
      reader.readAsDataURL(file); // Read the file as a data URL
    }
  }
</script>
@endsection