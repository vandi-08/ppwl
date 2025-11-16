@extends('layouts.app')
@section('title', 'Tambah Produk')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

  {{-- Breadcrumb dinamis --}}
  <x-breadcrumb :items="[
    'Produk' => route('products.index'),
    'Tambah Produk' => ''
  ]" />

  <div class="row">

    <div class="mb-4">
      <a href="{{ url()->previous() }}" class="btn btn-secondary">
        <i class="bx bx-arrow-back"></i> Kembali
      </a>
    </div>

    <div class="col-xxl">
      <div class="card mb-4">
        <div class="card-body">

          <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Foto Produk -->
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Foto</label>
              <div class="col-sm-10">
                <div class="input-group input-group-merge">
                  <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                </div>
                @error('foto')
                  <div class="text-danger small">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <!-- Nama Produk -->
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Nama</label>
              <div class="col-sm-10">
                <div class="input-group input-group-merge">
                  <span class="input-group-text"><i class="bx bx-package"></i></span>
                  <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Silahkan isi nama produk" value="{{ old('nama') }}">
                </div>
                @error('nama')
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
                  <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Silahkan isi deskripsi produk">{{ old('deskripsi') }}</textarea>
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
                  <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror" placeholder="100000" value="{{ old('harga') }}">
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
                  <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" placeholder="10" value="{{ old('stok') }}">
                </div>
                @error('stok')
                  <div class="text-danger small">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <!-- Submit -->
            <div class="row justify-content-end">
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </div>

          </form>

        </div>
      </div>
    </div>

  </div>
</div>
@endsection
