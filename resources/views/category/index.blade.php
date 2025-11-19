@extends('layouts.admin')

@section('title', 'Kategori')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <x-breadcrumb :items="[
        'Kategori' => route('category.index'),
        'Daftar Kategori' => ''
    ]" />

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Daftar Kategori</h5>

            <form action="" method="GET" class="d-flex" style="width: 300px;">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari..."
                       value="{{ request('search') }}">
                <button class="btn btn-primary btn-sm">Search</button>
            </form>

            <a href="{{ route('category.create') }}" class="btn btn-primary btn-sm">
                + Tambah Kategori
            </a>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $index => $category)
                    <tr>
                        <td>{{ $index + $categories->firstItem() }}</td>
                        <td>{{ $category->nama }}</td>
                        <td>
                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-primary">
                                Edit
                            </a>

                            <button onclick="deleteConfirm('{{ $category->id }}')" class="btn btn-sm btn-danger">
                                Hapus
                            </button>

                            <form id="delete-form-{{ $category->id }}" 
                                  action="{{ route('category.destroy', $category->id) }}" 
                                  method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection
