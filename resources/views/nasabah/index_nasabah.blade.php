@extends('layout.master')
@section('content')

    @php
        use App\Helpers\FormatHelper;
    @endphp

        <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Nasabah Pinjaman</h1>

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
                <a href="{{route('nasabah.create')}}" class="btn btn-info btn-icon-split col-auto">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus-square"></i>
                                        </span>
                    <span class="text">Tambah Data Pinjaman</span>
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Nasabah</th>
                            <th class="text-center">Jenis Pinjaman</th>
                            <th class="text-center">Besar Pinjaman</th>
                            <th class="text-center">Suku Bunga</th>
                            <th class="text-center">Lama Angsuran</th>
                            <th class="text-center">Sisa Angsuran</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Tanggal Pinjaman</th>
                            <th class="text-center">Jatuh Tempo</th>
                            <th class="text-center" style="width: 100px">Aksi</th>
                        </tr>

                        </thead>

                        <tbody>
                        @php $no = 0; @endphp
                        @foreach($nasabahs as $nasabah)
                            <tr>
                                <td class="text-center">{{ ++$no }}</td>
                                <td>{{ $nasabah->name }}</td>
                                <td>{{$nasabah->jenis_pinjaman}}</td>
                                <td>{{ FormatHelper::formatRupiah($nasabah->besar_pinjaman)}}</td>
                                <td class="text-center">{{$nasabah->bunga}} %</td>
                                <td class="text-center">{{$nasabah->lama_angsuran}} Bulan</td>
                                <td class="text-center">{{$nasabah->sisa_angsuran}} Bulan</td>
                                <td class="text-center">{{$nasabah->status_angsuran}}</td>
                                <td>{{$nasabah->tanggal_pinjaman}}</td>
                                <td>{{$nasabah->tanggal_jatuh_tempo}}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                          action="{{ route('nasabah.destroy', $nasabah->id) }}" method="POST">
                                        <a href="{{route('nasabah.show', $nasabah->id)}}"
                                           class="btn btn-info btn-icon-split btn-sm"
                                           data-bs-toggle="tooltip"
                                           data-bs-placement="top" title="Detail">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-info-circle"></i>
                                        </span>
                                            {{--                                            <span class="text">Detail</span>--}}
                                        </a>
                                        <a href="{{route('nasabah.edit', $nasabah)}}"
                                           class="btn btn-primary btn-icon-split btn-sm my-1" data-bs-toggle="tooltip"
                                           data-bs-placement="top" title="Edit">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-pen"></i>
                                        </span>
                                            {{--                                            <span class="text">Edit</span>--}}
                                        </a>
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-icon-split btn-sm"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><span
                                                class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                            {{--                                            <span class="text">Delete</span>--}}
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

