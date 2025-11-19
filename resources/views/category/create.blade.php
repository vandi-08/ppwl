@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <x-breadcrumb :items="[
        'Kategori' => route('category.index'),
        'Tambah Kategori' => ''
    ]" />

    <div class="card">
        <div class="card-body">

            <form action="{{ route('category.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Nama Kategori</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-primary">Simpan</button>
            </form>

        </div>
    </div>
</div>
@endsection
