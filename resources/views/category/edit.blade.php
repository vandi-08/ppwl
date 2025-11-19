@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <x-breadcrumb :items="[
        'Kategori' => route('category.index'),
        'Edit Kategori' => ''
    ]" />

    <div class="card">
        <div class="card-body">

            <form action="{{ route('category.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama Kategori</label>
                    <input type="text" name="nama" value="{{ $category->nama }}"
                           class="form-control @error('nama') is-invalid @enderror">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-primary">Update</button>
            </form>

        </div>
    </div>
</div>
@endsection
