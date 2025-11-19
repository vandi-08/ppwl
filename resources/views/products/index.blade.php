@extends('layouts.app')
@section('title', 'Daftar Produk')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

  {{-- Breadcrumb Dinamis --}}
  <x-breadcrumb :items="[
    'Produk' => route('products.index'),
    'Daftar Produk' => ''
  ]" />

  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Daftar Produk</h5>

      <!-- Search Form -->
      <form action="{{ route('products.index') }}" method="GET" class="d-flex" style="width: 300px;">
        <input
          type="text"
          name="search"
          class="form-control form-control-sm me-2"
          placeholder="Cari..."
          value="{{ request('search') }}"
        >
        <button class="btn btn-primary btn-sm" type="submit">
          <i class="bx bx-search"></i>
        </button>
      </form>
    </div>

    <div class="card-body">

      <!-- Alert Sukses -->
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      <!-- Tambah Produk -->
      <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">
        <i class="bx bx-plus"></i> Tambah Produk
      </a>

      <div class="table-responsive text-nowrap">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Foto</th>
              <th>Nama</th>
              <th>Kategori</th>
              <th>Harga</th>
              <th>Stok</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody>
            @forelse ($products as $product)
            <tr>
              <td>{{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}</td>

              <td>
                <img src="{{ asset('storage/' . $product->foto) }}" class="img-thumbnail" width="80">
              </td>

              <td>{{ $product->nama }}</td>
              <td>{{ $product->kategori->nama }}</td>
              <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
              <td>{{ $product->stok }}</td>

              <td>
                <!-- Edit -->
                <a href="{{ route('products.edit', $product->id) }}" 
                   class="btn btn-sm btn-primary">
                   <i class="bx bx-edit"></i>
                </a>

                <!-- Delete -->
                <form action="{{ route('products.destroy', $product->id) }}"
                      method="POST"
                      id="delete-{{ $product->id }}"
                      style="display:inline;">
                  @csrf
                  @method('DELETE')

                  <button type="button" class="btn btn-sm btn-danger"
                    onclick="deleteConfirm('{{ $product->id }}')">
                    <i class="bx bx-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7" class="text-center">Tidak ada produk.</td>
            </tr>
            @endforelse

          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="mt-3 d-flex justify-content-center">
        {{ $products->links('pagination::bootstrap-5') }}
      </div>

    </div>
  </div>
</div>
@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function deleteConfirm(id) {
    Swal.fire({
        title: 'Hapus Produk?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-' + id).submit();
        }
    });
}
</script>
@endpush
