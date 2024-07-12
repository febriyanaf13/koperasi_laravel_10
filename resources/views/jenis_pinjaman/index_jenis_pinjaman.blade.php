@extends('layout.master')
@section('content')

    @php
        use App\Helpers\FormatHelper;
    @endphp

        <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Daftar Jenis Pinjaman</h1>

        @if (session('success'))
            <div class="col-lg-12 mb-4">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                        Success
                        <div class="text-white-50 small">{{ session('success') }}</div>
                    </div>
                </div>
            </div>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('jenis_pinjaman.create') }}" class="btn btn-info btn-icon-split col-auto">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus-square"></i>
                    </span>
                    <span class="text">Tambah Data</span>
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Jenis Pinjaman</th>
                            <th class="text-center">Maksimal Pinjaman</th>
                            <th class="text-center">Lama Angsur</th>
                            <th class="text-center">Bunga (%)</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $no = 0; @endphp
                        @foreach($jenisPinjaman as $jp)
                            <tr>
                                <td class="text-center">{{ ++$no }}</td>
                                <td>{{ $jp->jenis_pinjaman }}</td>
                                <td>{{FormatHelper::formatRupiah( $jp->maks_pinjaman )}}</td>
                                <td class="text-center">{{ $jp->lama_angsuran }} Bulan</td>
                                <td class="text-center" style="width: 200px">{{ $jp->bunga }}%</td>
                                <td class="text-center" style="width: 300px">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                          action="{{ route('jenis_pinjaman.destroy', $jp->id) }}" method="POST">

                                        <a href="{{ route('jenis_pinjaman.edit', $jp->id) }}"
                                           class="btn btn-primary btn-icon-split btn-sm my-1" data-bs-toggle="tooltip"
                                           data-bs-placement="top" title="Edit">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-pen"></i>
                                            </span>
                                            <span class="text">Edit</span>

                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-icon-split btn-sm"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">Delete</span>

                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->


@endsection
