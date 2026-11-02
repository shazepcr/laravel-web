
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

{{-- Tabel pelanggan --}}
<div class="row">
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
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
