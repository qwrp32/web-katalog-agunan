@extends('layouts.dash')

@section('title', 'Home')

@section('content')
<h1>Semua Listing</h1>
<div class="row mb-3">
    <div class="col text-start">
        <a href="{{ route('newListing') }}" class="btn btn-primary btn-md">
            <i class="bi bi-plus-circle"></i> Tambah Listing
        </a>
    </div>
</div>
<div class="row"><div class="col text-start">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No.</th>
                <th>Aksi</th>
                <th>Judul</th>
                <th>Perkiraan Harga Jual</th>
                <th>Tanggal Input</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($listings as $index => $listing)
                <tr>
                    <td style="white-space: nowrap; width: 1%;"> {{ $listings->firstItem() + $index }}</td>
                    <td style="white-space: nowrap; width: 1%;">
                    <div class="d-flex gap-2">
                        <a href="{{ route('editListing', $listing->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('listing.destroy', $listing->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                    </td>
                    <td>{{ $listing->nama_agunan }}</td>
                    <td>{{ 'Rp. ' . number_format($listing->pricing->harga_jual, 0, ',', '.') }}</td>
                    <td>{{ $listing->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No posts available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <!-- Pagination -->
</div>
</div>
<!-- Pagination -->
<div class="d-flex justify-content-center mt-4">
        <ul class="pagination pagination-sm">
            {{ $listings->links() }} <!-- Display pagination links -->
        </ul>
</div>
@endsection
