@extends('layout.master')
@section('content')

    @php
        use App\Helpers\FormatHelper;
        use App\Helpers\DendaHelper;
    @endphp

        <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Edit Angsuran untuk Nasabah: {{ $angsuran->pinjaman->name }}</h1>

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

        <div class="row">
            <!-- Data Pinjaman Nasabah -->
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Pinjaman Nasabah</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Nama Nasabah</th>
                                <td>{{ $angsuran->pinjaman->name }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Pinjaman</th>
                                <td>{{ $angsuran->pinjaman->jenis_pinjaman }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Pinjaman</th>
                                <td>{{ $angsuran->pinjaman->tanggal_pinjaman }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Jatuh Tempo</th>
                                <td>{{ $angsuran->pinjaman->tanggal_jatuh_tempo }}</td>
                            </tr>
                            <tr>
                                <th>Besar Pinjaman</th>
                                <td>{{ FormatHelper::formatRupiah($angsuran->pinjaman->besar_pinjaman) }}</td>
                            </tr>
                            <tr>
                                <th>Suku Bunga</th>
                                <td>{{ $angsuran->pinjaman->bunga }} %</td>
                            </tr>
                            <tr>
                                <th>Angsuran Perbulan</th>
                                <td>{{ FormatHelper::formatRupiah($angsuran->pinjaman->angsuran_perbulan) }} </td>
                            </tr>
                            <tr>
                                <th>Denda</th>
                                <td>{{ FormatHelper::formatRupiah( DendaHelper::hitungDenda($angsuran->pinjaman->angsuran_perbulan, $angsuran->pinjaman->bunga,$angsuran->pinjaman->tanggal_jatuh_tempo))}}</td>
                            </tr>
                            <tr>
                                <th>Nominal yang harus dibayar bulan ini</th>
                                <td>{{ FormatHelper::formatRupiah( DendaHelper::hitungDenda($angsuran->pinjaman->angsuran_perbulan, $angsuran->pinjaman->bunga,$angsuran->pinjaman->tanggal_jatuh_tempo) + $angsuran->pinjaman->angsuran_perbulan )}}</td>
                            </tr>
                            <tr>
                                <th>Lama Angsuran</th>
                                <td>{{ $angsuran->pinjaman->lama_angsuran }} Bulan</td>
                            </tr>
                            <tr>
                                <th>Sisa Angsuran</th>
                                <td>{{ $angsuran->sisa_angsuran }} Bulan</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ $angsuran->pinjaman->status_angsuran }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Form Edit Angsuran -->
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form id="angsuranForm" action="{{ route('angsurans.update', $angsuran->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="nasabah_id" value="{{ $angsuran->pinjaman->id }}">
                            <div class="form-group">
                                <label for="tanggal_angsuran">Angsuran Ke</label>
                                <input type="number" class="form-control" id="tanggal_angsuran" name="tanggal_angsuran"
                                       max="{{ $angsuran->pinjaman->lama_angsuran }}"
                                       min="{{  $angsuran->pinjaman->lama_angsuran - $angsuran->pinjaman->sisa_angsuran }}"
                                       value="{{ $angsuran->angsuran_ke }}" required>
                                @error('tanggal_angsuran')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nominal">Nominal Angsuran (Angsuran Perbulan + Denda)</label>
                                <input type="text" class="form-control" id="nominal" name="nominal"
                                       oninput="formatRupiah(this)" value="{{ old('nominal', FormatHelper::formatRupiah($angsuran->nominal_angsuran)) }}" required>
                                @error('nominal')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan">{{ $angsuran->keterangan }}</textarea>
                            </div>

                            <!-- Hidden Input untuk id_pinjaman -->
                            <input type="hidden" name="pinjaman_id" id="pinjaman_id" value="{{ $angsuran->pinjaman->id }}">
                            <input type="hidden" name="sisa_angsuran" id="sisa_angsuran"
                                   value="{{ $angsuran->pinjaman->sisa_angsuran }}">
                            <input type="hidden" name="lama_angsuran" id="lama_angsuran"
                                   value="{{ $angsuran->pinjaman->lama_angsuran }}">
                            <input type="hidden" name="angsuran_perbulan" id="angsuran_perbulan"
                                   value="{{ $angsuran->pinjaman->angsuran_perbulan }}">
                            <input type="hidden"
                                   name="jenis_pinjaman"
                                   id="jenis_pinjaman"
                                   value="{{ $angsuran->pinjaman->jenis_pinjaman }}">
                            <input type="hidden"
                                   name="angsuran_perbulan"
                                   id="angsuran_perbulan"
                                   value="{{ $angsuran->pinjaman->angsuran_perbulan }}">
                            <input type="hidden"
                                   name="denda"
                                   id="denda"
                                   value="{{ DendaHelper::hitungDenda($angsuran->pinjaman->angsuran_perbulan, $angsuran->pinjaman->bunga, $angsuran->pinjaman->tanggal_jatuh_tempo) }}">

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function formatRupiah(element) {
            let value = element.value.replace(/[^,\d]/g, '');
            if (value !== "") {
                value = parseInt(value, 10);
                element.value = formatToRupiah(value);
            }
        }

        function formatToRupiah(value) {
            let reverse = value.toString().split('').reverse().join('');
            let rupiah = reverse.match(/\d{1,3}/g);
            rupiah = rupiah.join('.').split('').reverse().join('');
            return 'Rp ' + rupiah;
        }
    </script>
@endsection
