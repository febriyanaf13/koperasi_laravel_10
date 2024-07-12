@extends('layout.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Edit Jenis Pinjaman</h1>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="col-lg-12" style="margin-bottom: 20px">
                    <div class="card bg-danger text-white shadow">
                        <div class="card-body">
                            Gagal
                            <div class="text-white-50 small">{{ $error }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('jenis_pinjaman.update', $jenisPinjaman->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_pinjaman">Jenis Pinjaman</label>
                                <input type="text" class="form-control" id="jenis_pinjaman" name="jenis_pinjaman"
                                       value="{{ old('jenis_pinjaman', $jenisPinjaman->jenis_pinjaman) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="maks_pinjaman">Maksimal Pinjaman (Rp)</label>
                                <input type="text" class="form-control" id="maks_pinjaman" name="maks_pinjaman"
                                       value="{{ old('maks_pinjaman', number_format($jenisPinjaman->maks_pinjaman, 0, ',', '.')) }}"
                                       oninput="formatRupiah(this)" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lama_angsuran">Lama Angsuran (Bulan)</label>
                                <input type="number" class="form-control" id="lama_angsuran" name="lama_angsuran"
                                       value="{{ old('lama_angsuran', $jenisPinjaman->lama_angsuran) }}" min="0"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="bunga">Bunga (%)</label>
                                <input type="number" class="form-control" id="bunga" name="bunga"
                                       value="{{ old('bunga', $jenisPinjaman->bunga) }}" step="0.01" min="0" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
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
