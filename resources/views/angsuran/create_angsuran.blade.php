@extends('layout.master')
@section('content')

    @php
        use App\Helpers\FormatHelper;
        use App\Helpers\DendaHelper;
    @endphp

        <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tambah Angsuran untuk Nasabah: {{ $nasabah->name }}</h1>

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
                                <td>{{ $nasabah->name }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Pinjaman</th>
                                <td>{{ $nasabah->jenis_pinjaman }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Pinjaman</th>
                                <td>{{ $nasabah->tanggal_pinjaman }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Jatuh Tempo</th>
                                <td>{{ $nasabah->tanggal_jatuh_tempo }}</td>
                            </tr>
                            <tr>
                                <th>Besar Pinjaman</th>
                                <td>{{ FormatHelper::formatRupiah($nasabah->besar_pinjaman) }}</td>
                            </tr>
                            <tr>
                                <th>Suku Bunga</th>
                                <td>{{ $nasabah->bunga }} %</td>
                            </tr>
                            <tr>
                                <th>Angsuran Perbulan</th>
                                <td>{{ FormatHelper::formatRupiah($nasabah->angsuran_perbulan) }} </td>
                            </tr>
                            <tr>
                                <th>Denda</th>
                                <td>{{ FormatHelper::formatRupiah( DendaHelper::hitungDenda($nasabah->angsuran_perbulan, $nasabah->bunga,$nasabah->tanggal_jatuh_tempo))}}</td>
                            </tr>
                            <tr>
                                <th>Nominal yang harus dibayar bulan ini</th>
                                <td>{{ FormatHelper::formatRupiah( DendaHelper::hitungDenda($nasabah->angsuran_perbulan, $nasabah->bunga,$nasabah->tanggal_jatuh_tempo) + $nasabah->angsuran_perbulan )}}</td>
                            </tr>
                            <tr>
                                <th>Lama Angsuran</th>
                                <td>{{ $nasabah->lama_angsuran }} Bulan</td>
                            </tr>
                            <tr>
                                <th>Sisa Angsuran</th>
                                <td>{{ $nasabah->sisa_angsuran }} Bulan</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ $nasabah->status_angsuran }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Form Input Angsuran -->
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form id="angsuranForm" action="{{ route('angsurans.store', $nasabah->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="nasabah_id" value="{{ $nasabah->id }}">
                            <div class="form-group">
                                <label for="tanggal_angsuran">Angsuran Ke</label>
                                <input type="number" class="form-control" id="tanggal_angsuran" name="tanggal_angsuran"
                                       max="{{$nasabah->lama_angsuran}}"
                                       min="{{$nasabah->lama_angsuran - $nasabah->sisa_angsuran + 1}}"
                                       value="{{$nasabah->lama_angsuran - $nasabah->sisa_angsuran + 1}}" required>
                                @error('tanggal_angsuran')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nominal">Nominal Angsuran (Angsuran Perbulan + Denda)</label>
                                <input type="text" class="form-control" id="nominal" name="nominal"
                                       oninput="formatRupiah(this)" required>
                                @error('nominal')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nominal">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan"
                                ></textarea>

                            </div>
                            <!-- Hidden Input untuk id_pinjaman -->
                            <input type="hidden" name="pinjaman_id" id="pinjaman_id" value="{{ $nasabah->id }}">
                            <input type="hidden" name="sisa_angsuran" id="sisa_angsuran"
                                   value="{{ $nasabah->sisa_angsuran }}">
                            <input type="hidden" name="lama_angsuran" id="lama_angsuran"
                                   value="{{ $nasabah->lama_angsuran }}">
                            <input type="hidden" name="angsuran_perbulan" id="angsuran_perbulan"
                                   value="{{ $nasabah->angsuran_perbulan }}">
                            <input type="hidden"
                                   name="jenis_pinjaman"
                                   id="jenis_pinjaman"
                                   value="{{ $nasabah->jenis_pinjaman }}">
                            <input type="hidden"
                                   name="angsuran_perbulan"
                                   id="angsuran_perbulan"
                                   value="{{ $nasabah->angsuran_perbulan }}">
                            <input type="hidden"
                                   name="denda"
                                   id="denda"
                                   value="{{ DendaHelper::hitungDenda($nasabah->angsuran_perbulan, $nasabah->bunga,$nasabah->tanggal_jatuh_tempo) }}">

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();


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
