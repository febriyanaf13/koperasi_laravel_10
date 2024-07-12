@extends('layout.master')
@section('content')

    @php
        use App\Helpers\FormatHelper;
    @endphp

    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Data Transaksi</h1>

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

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('transaksis.create') }}" class="btn btn-info btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah Transaksi</span>
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Jenis</th>
                            <th class="text-center">Nominal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($transaksis as $transaksi)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $transaksi->nama }}</td>
                                <td>{{ $transaksi->tgl }}</td>
                                <td>{{ $transaksi->jenis }}</td>
                                <td>{{ FormatHelper::formatRupiah($transaksi->nominal) }}</td>
                                <td class="text-center" style="width: 300px">
                                    @if ($transaksi->nama !== 'PINJAMAN' && $transaksi->nama !== 'ANGSURAN')
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('transaksis.destroy', $transaksi->id) }}" method="POST">
                                            <a href="{{ route('transaksis.edit', $transaksi->id) }}" class="btn btn-primary btn-icon-split btn-sm my-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-pen"></i>
                                                </span>
                                                <span class="text">Edit</span>
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-icon-split btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                                <span class="text">Delete</span>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
