@extends('layout.master')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Tambah Transaksi</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('transaksis.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama Transaksi</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}"
                                       required>
                                @error('nama')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tgl">Tanggal</label>
                                <input type="date" class="form-control" id="tgl" name="tgl" value="{{ old('tgl') }}"
                                       required>
                                @error('tgl')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis">Jenis Transaksi</label>
                                <select class="custom-select" name="jenis" id="jenis"
                                        oninput="updatePreview();" required>
                                    <option value="">Choose...</option>
                                    <option value="masuk">Pemasukan</option>
                                    <option value="keluar">Pengeluaran</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid jenis.
                                </div>
                                @error('jenis')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nominal">Nominal</label>
                                <input type="text" class="form-control" id="nominal" name="nominal"
                                       value="{{ old('nominal') }}" oninput="formatRupiah(this)" required>
                                @error('nominal')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
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
