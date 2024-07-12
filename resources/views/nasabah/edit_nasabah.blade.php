@extends('layout.master')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Edit Pinjaman</h1>

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

        <div class="row col-md-12">
            <div class="col-md-7">
                <div class="card mb-6 py-3 border-left-primary">
                    <div class="card-body">
                        <form action="{{ route('nasabah.update', $nasabah->id) }}" method="POST"
                              enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="name">Nama Nasabah</label>
                                    <select class="custom-select" name="name" id="name" oninput="updatePreview()"
                                            required>
                                        <option value="">Choose...</option>
                                        @foreach($users as $user)
                                            <option
                                                value="{{ $user }}" {{ $nasabah->name == $user->name ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid role.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lama_angsuran">Lama Angsuran (Bulan)</label>
                                    <input type="number" class="form-control" name="lama_angsuran" id="lama_angsuran"
                                           min="0" value="{{ $nasabah->lama_angsuran }}" oninput="updatePreview();"
                                           required>
                                    <div class="invalid-feedback">
                                        Please provide a valid email.
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="jenis_pinjaman">Jenis Pinjaman</label>
                                    <select class="custom-select" name="jenis_pinjaman" id="jenis_pinjaman"
                                            oninput="updatePreview();" required>
                                        <option value="">Choose...</option>
                                        @foreach($jenisPinjamans as $jp)
                                            <option
                                                value="{{ $jp }}" {{ $nasabah->jenis_pinjaman == $jp->jenis_pinjaman ? 'selected' : '' }}>{{ $jp->jenis_pinjaman }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid role.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="besar_pinjaman">Besar Pinjaman</label>
                                    <input type="text" id="besar_pinjaman" name="besar_pinjaman" class="form-control"
                                           placeholder="Masukkan nominal pinjaman..."
                                           value="{{ $nasabah->besar_pinjaman }}"
                                           oninput="formatRupiah(this); updatePreview();" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid besar pinjaman.
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="jenis_pinjaman">Jenis Bunga</label>
                                    <select class="custom-select" name="jenis_bunga" id="jenis_bunga"
                                            oninput="updatePreview()" required>
                                        <option value="">Choose...</option>
                                        @foreach($jenisBungas as $jb)
                                            <option
                                                value="{{ $jb->name }}" {{ $nasabah->tipe_bunga == $jb->name ? 'selected' : '' }}>{{ $jb->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid jenis pinjaman.
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Update</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card col-md-5 mb-12 py-3 border-left-primary">
                <div class="preview-container" style="padding: 50px">
                    <div id="document-preview">
                        <h2 style="margin-bottom: 50px" class="text-center">Bukti Pengajuan Pinjaman PKK Desa Lebak
                            Grobogan</h2>
                        <div
                            style="display: flex; justify-content: space-between; text-align: justify; padding-bottom: 20px">
                            <strong>Nama Peminjam :</strong> <span id="preview-name"></span>
                        </div>
                        <div
                            style="display: flex; justify-content: space-between; text-align: justify; padding-bottom: 20px">
                            <strong>Jenis Pinjaman :</strong> <span id="preview-jenis-pinjaman"></span></div>
                        <h4 style="margin-top: 30px; padding-bottom: 20px">Detail Pinjaman</h4>
                        <div
                            style="display: flex; justify-content: space-between; text-align: justify; padding-bottom: 20px">
                            <strong>Besar Pinjaman :</strong> <span id="preview-besar-pinjaman"></span></div>
                        <div
                            style="display: flex; justify-content: space-between; text-align: justify; padding-bottom: 20px">
                            <strong>Bunga :</strong> <span id="preview-bunga"></span></div>
                        <div
                            style="display: flex; justify-content: space-between; text-align: justify; padding-bottom: 20px">
                            <strong>Tipe Bunga :</strong> <span id="preview-jenis-bunga"></span></div>
                        <div
                            style="display: flex; justify-content: space-between; text-align: justify; padding-bottom: 20px">
                            <strong>Bunga Perbulan :</strong> <span id="preview-bunga-perbulan"></span></div>
                        <div
                            style="display: flex; justify-content: space-between; text-align: justify; padding-bottom: 20px">
                            <strong>Angsuran Perbulan :</strong> <span id="preview-angsuran-perbulan"></span></div>
                        <div
                            style="display: flex; justify-content: space-between; text-align: justify; padding-bottom: 20px">
                            <strong>Lama Angsuran :</strong> <span id="preview-lama-angsuran"></span></div>
                        <div
                            style="display: flex; justify-content: space-between; text-align: justify; padding-bottom: 20px">
                            <strong>Total Bunga Harus Dibayar :</strong> <span
                                id="preview-total-bunga-harus-dibayar"></span>
                        </div>
                        <div class="container"
                             style="display: flex; justify-content: flex-end; padding-bottom: 20px; padding-top: 50px">
                            <div
                                style="display: flex; flex-direction: column; text-align: center; padding-bottom: 20px">
                                <div style="text-align: center; padding-bottom: 20px">
                                    <strong>Lebak, {{ $today }}</strong></div>
                                <div style=" text-align: center; padding-bottom: 20px; padding-top: 50px">
                                    <strong>Ketua</strong></div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" onclick="generatePDF()">Cetak</button>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Populate the preview with existing data
        updatePreview();
    });

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

    function updatePreview() {
        let namaPeminjam = JSON.parse(document.getElementById('name').value);
        document.getElementById('preview-name').textContent = namaPeminjam.name;
        document.getElementById('preview-lama-angsuran').textContent = document.getElementById('lama_angsuran').value;
        document.getElementById('preview-besar-pinjaman').textContent = document.getElementById('besar_pinjaman').value;
        document.getElementById('preview-jenis-bunga').textContent = document.getElementById('jenis_bunga').value;

        const lamaAngsuran = document.getElementById('lama_angsuran').value;
        const jenisPinjaman = document.getElementById('jenis_pinjaman').value;
        const besarPinjaman = document.getElementById('besar_pinjaman').value;

        let selectedObject = JSON.parse(jenisPinjaman);

        let totalBungaHarusDibayar = selectedObject.bunga / 100 * rupiahToDecimal(besarPinjaman);
        let totalBunga = selectedObject.bunga / 100 * rupiahToDecimal(besarPinjaman);
        let bungaPerbulan = totalBunga / lamaAngsuran;

        let totalPerbulan = totalBungaHarusDibayar + rupiahToDecimal(besarPinjaman) / lamaAngsuran;
        let nominalBunga = selectedObject.bunga;

        document.getElementById('preview-jenis-pinjaman').textContent = selectedObject.jenis_pinjaman;
        document.getElementById('preview-total-bunga-harus-dibayar').textContent = formatToRupiah(totalBunga);
        document.getElementById('preview-bunga').textContent = `${nominalBunga} %`;
        document.getElementById('preview-bunga-perbulan').textContent = formatToRupiah(bungaPerbulan);
        document.getElementById('preview-angsuran-perbulan').textContent = formatToRupiah(totalPerbulan);
    }

    function rupiahToDecimal(rupiah) {
        let cleanedString = rupiah.replace(/[Rp.]/g, '');
        return parseInt(cleanedString, 10);
    }

    function generatePDF() {
        const element = document.getElementById('document-preview');
        const options = {
            filename: 'document.pdf',
            margin: [10, 10, 10, 10],
            jsPDF: {unit: 'pt', format: 'a4', orientation: 'portrait'}
        };
        html2pdf().set(options).from(element).save();
    }
</script>
