@extends('layouts.app')
@section('title', 'Edit Produk')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

  {{-- Breadcrumb Dinamis --}}
  <x-breadcrumb :items="[
    'Produk' => route('products.index'),
    'Edit Produk' => ''
  ]" />

  <div class="mb-4">
    <a href="{{ route('products.index') }}" class="btn btn-secondary">
      <i class="bx bx-arrow-back"></i> Kembali
    </a>
  </div>

  <div class="card">
    <div class="card-body">

      <form action="{{ route('products.update', $product->id) }}" 
            method="POST" 
            enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Foto Produk -->
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label">Foto Produk</label>
          <div class="col-sm-10">

            <!-- Foto Lama -->
            @if($product->foto)
              <img src="{{ asset('storage/' . $product->foto) }}" 
                   width="120"
                   class="img-thumbnail mb-2">
            @endif

            <input type="file" 
                   name="foto" 
                   class="form-control @error('foto') is-invalid @enderror">

            @error('foto')
              <div class="text-danger small">{{ $message }}</div>
            @enderror

          </div>
        </div>

        <!-- Nama Produk -->
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label">Nama Produk</label>
          <div class="col-sm-10">
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-shopping-bag"></i></span>
              <input 
                type="text" 
                name="nama" 
                class="form-control @error('nama') is-invalid @enderror"
                value="{{ old('nama', $product->nama) }}"
              >
            </div>
            @error('nama')
              <div class="text-danger small">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <!-- Kategori -->
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label">Kategori</label>
          <div class="col-sm-10">

            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-category"></i></span>
              <select 
                name="kategori_id" 
                class="form-select @error('kategori_id') is-invalid @enderror">

                @foreach($categories as $cat)
                  <option value="{{ $cat->id }}"
                    {{ $product->kategori_id == $cat->id ? 'selected' : '' }}>
                    {{ $cat->nama }}
                  </option>
                @endforeach
              </select>
            </div>

            @error('kategori_id')
              <div class="text-danger small">{{ $message }}</div>
            @enderror

          </div>
        </div>

        <!-- Deskripsi -->
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label">Deskripsi</label>
          <div class="col-sm-10">
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-comment-detail"></i></span>
              <textarea 
                name="deskripsi" 
                class="form-control @error('deskripsi') is-invalid @enderror"
              >{{ old('deskripsi', $product->deskripsi) }}</textarea>
            </div>
            @error('deskripsi')
              <div class="text-danger small">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <!-- Harga -->
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label">Harga</label>
          <div class="col-sm-10">
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-dollar-circle"></i></span>
              <input 
                type="number" 
                name="harga" 
                class="form-control @error('harga') is-invalid @enderror"
                value="{{ old('harga', $product->harga) }}"
              >
            </div>
            @error('harga')
              <div class="text-danger small">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <!-- Stok -->
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label">Stok</label>
          <div class="col-sm-10">
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-package"></i></span>
              <input 
                type="number" 
                name="stok" 
                class="form-control @error('stok') is-invalid @enderror"
                value="{{ old('stok', $product->stok) }}"
              >
            </div>
            @error('stok')
              <div class="text-danger small">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <!-- Tombol Submit -->
        <div class="row justify-content-end">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">
              <i class="bx bx-save"></i> Simpan Perubahan
            </button>
          </div>
        </div>

      </form>

    </div>
  </div>

</div>
@endsection
