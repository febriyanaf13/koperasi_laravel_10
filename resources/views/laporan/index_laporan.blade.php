@extends('layout.master')
@section('content')

    @php
        use App\Helpers\FormatHelper;
    @endphp

    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Laporan Transaksi dan Pinjaman</h1>

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
                <form action="{{ route('laporans.index') }}" method="GET">
                    <div class="row align-items-center">
                        <div class="form-group col-md-4">
                            <label for="bulan">Pilih Bulan</label>
                            <select class="custom-select" id="bulan" name="bulan">
                                @foreach (range(1, 12) as $month)
                                    <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 10)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tahun">Pilih Tahun</label>
                            <select class="custom-select" id="tahun" name="tahun">
                                @foreach (range(date('Y'), 2000) as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 text-right">
                            <button type="submit" class="btn btn-primary">Tampilkan Laporan</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <h4>Transaksi</h4>
                    <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Jenis</th>
                            <th class="text-center">Nominal</th>
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
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <h4>Pinjaman</h4>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Durasi</th>
                            <th class="text-center">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($pinjaman as $pinjam)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $pinjam->name }}</td>
                                <td>{{ $pinjam->tanggal_pinjaman }}</td>
                                <td>{{ FormatHelper::formatRupiah($pinjam->besar_pinjaman) }}</td>
                                <td class="text-center">{{ $pinjam->lama_angsuran }} bulan</td>
                                <td class="text-center">{{ $pinjam->status_angsuran }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>


@endsection
