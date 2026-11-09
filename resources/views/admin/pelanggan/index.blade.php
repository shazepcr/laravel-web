
@extends('layouts.admin.app')

@section('content')

{{-- Notifikasi berhasil --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mx-4"
         role="alert">
        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"></button>
    </div>
@endif

{{-- Notifikasi gagal validasi --}}
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mx-4"
         role="alert">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"></button>
    </div>
@endif

{{-- Header halaman --}}
<div class="d-flex justify-content-between w-100 flex-wrap mb-3">
    <div class="mb-3 mb-lg-0">
        <h1 class="h4">Data Pelanggan</h1>
        <p class="mb-0">List data seluruh pelanggan</p>
    </div>

    <div>
        <a href="{{ route('pelanggan.create') }}"
           class="btn btn-success text-white">
            Tambah Pelanggan
        </a>
    </div>
</div>

        <!-- Form Filter Gender -->
        <div class="table-responsive">
            <form method="GET" action="{{ route('pelanggan.index') }}" onchange="this.form.submit()" class="mb-3">
                <div class="row">
                    <div class="col-md-2">
                        <select name="gender" class="form-select">
                            <option value="">All Genders</option>
                            <option value="Male" {{ request('gender')=='Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ request('gender')=='Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

              <!-- Tambah Form Search -->
            <div class="col-md-3">
                <div class="input-group" style="max-width: 300px;">
                    <input type="text" name="search"
                        class="form-control"
                        id="exampleInputIconRight"
                        value="{{ request('search') }}"
                        placeholder="Search"
                        aria-label="Search">

                    <button type="submit" class="input-group-text" id="basic-addon2">
                        <svg class="icon icon-xxs" fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>

                    @if(request('search'))
                        <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                            class="btn btn-outline-secondary ml-3"
                            id="clear-search">
                            Clear
                        </a>
                    @endif
                </div>
        </div>


{{-- Tabel pelanggan --}}
<div class="row mt-3">
    <div class="col-12 mb-4">
        <div class="card border-0 shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table-pelanggan"
                           class="table table-centered table-nowrap mb-0 rounded">

                        <thead class="thead-light">
                            <tr>
                                <th class="border-0">First Name</th>
                                <th class="border-0">Last Name</th>
                                <th class="border-0">Birthday</th>
                                <th class="border-0">Gender</th>
                                <th class="border-0">Email</th>
                                <th class="border-0">Phone</th>
                                <th class="border-0 rounded-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($dataPelanggan as $item)
                                <tr>
                                    <td>{{ $item->first_name }}</td>
                                    <td>{{ $item->last_name }}</td>
                                    <td>{{ $item->birthday }}</td>
                                    <td>{{ $item->gender }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>
                                        <a href="{{ route('pelanggan.edit', $item->pelanggan_id) }}"
                                           class="btn btn-info btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('pelanggan.destroy', $item->pelanggan_id) }}"
                                              method="POST"
                                              style="display:inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus data pelanggan ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        Belum ada data pelanggan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- menampilkan list tombol  -->
                    <div class="mt-3">
                        {{ $dataPelanggan->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
