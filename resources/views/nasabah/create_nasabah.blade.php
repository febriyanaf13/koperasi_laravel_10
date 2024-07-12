@extends('layout.master')
@section('content')

    @php
        use Carbon\Carbon;

    @endphp
        <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tambah Pinjaman</h1>


        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="col-lg-12" style="margin-bottom: 20px" role="alert">
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
                        <form action="{{ route('nasabah.store') }}" method="POST" enctype="multipart/form-data"
                              class="needs-validation" novalidate>
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="name">Nama Nasabah</label>
                                    <select class="custom-select" name="name" id="name" oninput="updatePreview()"
                                            required>
                                        <option value="">Choose...</option>
                                        @if(count($users) >=1)
                                            @foreach($users as $user)
                                                <option value="{{ $user }}">{{$user->name}}</option>
                                            @endforeach
                                        @endif

                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid role.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lama_angsuran">Lama Angsuran (Bulan)</label>
                                    <input type="number" class="form-control" name="lama_angsuran" id="lama_angsuran"
                                           min="0"
                                           value="0" oninput="updatePreview();" required>
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
                                        @if(count($jenisPinjamans) >=1)
                                            @foreach($jenisPinjamans as $jp)
                                                <option
                                                    value="{{ $jp }}">{{$jp->jenis_pinjaman}}</option>
                                            @endforeach
                                        @endif

                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid role.
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="besar_pinjaman">Besar Pinjaman</label>
                                    <input type="text" id="besar_pinjaman" name="besar_pinjaman" class="form-control"
                                           placeholder="Masukkan nominal pinjaman..."
                                           oninput="formatRupiah(this); updatePreview();"
                                           required>
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
                                        @if(count($jenisBungas) >=1)
                                            @foreach($jenisBungas as $jb)
                                                <option value="{{ $jb->name }}">{{$jb->name}}</option>
                                            @endforeach
                                        @endif

                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid jenis pinjaman.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tgl_pinjaman">Tanggal Pinjaman</label>
                                    <input type="date" id="tgl_pinjaman" name="tgl_pinjaman" class="form-control"
                                           required>
                                    <div class="invalid-feedback">
                                        Please provide a valid date.
                                    </div>
                                </div>


                            </div>

                            <button class="btn btn-primary" type="submit">Simpan</button>
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
                            <strong>Lama Angsuran :</strong> <span id="preview-lama-angsuran"></span></div>
                        <div
                            style="display: flex; justify-content: space-between; text-align: justify; padding-bottom: 20px">
                            <strong>Bunga Perbulan % :</strong> <span id="preview-bunga-perbulan"></span></div>
                        <div
                            style="display: flex; justify-content: space-between; text-align: justify; padding-bottom: 20px">
                            <strong>Total Bunga % :</strong> <span id="preview-bunga"></span></div>
                        <div
                            style="display: flex; justify-content: space-between; text-align: justify; padding-bottom: 20px">
                            <strong>Tipe Bunga :</strong> <span id="preview-jenis-bunga"></span></div>
                        <div
                            style="display: flex; justify-content: space-between; text-align: justify; padding-bottom: 20px">
                            <strong>Nominal
                                Bunga Perbulan :</strong> <span id="preview-total-bunga-harus-dibayar"></span>
                        </div>
                        <div
                            style="display: flex; justify-content: space-between; text-align: justify; padding-bottom: 20px">
                            <strong>Angsuran Perbulan :</strong> <span id="preview-angsuran-perbulan"></span></div>

                        <div class="container"
                             style="display: flex; justify-content: flex-end;  padding-bottom: 20px; padding-top: 50px">
                            <div
                                style="display: flex;  flex-direction: column; text-align: center; padding-bottom: 20px">
                                <div
                                    style="text-align: center; padding-bottom: 20px">
                                    <strong id="preview-tgl-pinjaman">Lebak, {{ $today }}</strong></div>

                                <div
                                    style=" text-align: center; padding-bottom: 20px; padding-top: 50px">
                                    <strong>Ketua</strong></div>

                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" onclick="generatePDF()">Cetak</button>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <style>
        /* Gaya umum untuk halaman */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Gaya khusus untuk tampilan cetak */
        @media print {
            @page {
                size: A4; /* Mengatur ukuran kertas ke A4 */
                margin: 20mm; /* Mengatur margin kertas */
            }

            body * {
                visibility: hidden; /* Menyembunyikan semua elemen di halaman */
            }

            #document-preview, #document-preview * {
                visibility: visible; /* Menampilkan hanya elemen dalam #document-preview */
            }

            #document-preview {
                position: absolute;
                left: 0;
                top: 0;
                width: calc(100% - 40mm); /* Mengurangi margin dari lebar kertas */
                height: calc(100% - 40mm); /* Mengurangi margin dari tinggi kertas */
                margin: 20mm; /* Mengatur margin kertas */
                padding: 20px;
                box-sizing: border-box;
                display: block; /* Mengatur display menjadi block */
                text-align: center; /* Teks rata kiri */
            }

            /* Aturan tambahan untuk menjaga tata letak yang rapi */
            h1, p {
                margin: 0;
                padding: 10px 0;
            }
        }
    </style>

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

        function updatePreview() {

            let namaPeminjam = JSON.parse(document.getElementById('name').value);
            let tglPinjaman = document.getElementById('tgl_pinjaman').value


            document.getElementById('preview-name').textContent = namaPeminjam.name;
            document.getElementById('preview-lama-angsuran').textContent = document.getElementById('lama_angsuran').value;
            document.getElementById('preview-besar-pinjaman').textContent = document.getElementById('besar_pinjaman').value;
            document.getElementById('preview-jenis-bunga').textContent = document.getElementById('jenis_bunga').value;


            // Set preview tanggal pinjaman
            let formattedDate = "{{ Carbon::parse('') }}";
            if (tglPinjaman) {
                formattedDate = "{{ Carbon::parse('') }}".replace('', tglPinjaman);
                document.getElementById('preview-tgl-pinjaman').textContent = formattedDate;
            }

            const lamaAngsuran = document.getElementById('lama_angsuran').value;
            const jenisPinjaman = document.getElementById('jenis_pinjaman').value;
            const besarPinjaman = document.getElementById('besar_pinjaman').value;


            // Parsing nilai JSON menjadi objek JavaScript
            let selectedObject = JSON.parse(jenisPinjaman);

            // Mengakses properti objek untuk ditampilkan atau diproses
            let totalBungaHarusDibayar = selectedObject.bunga / 100 * rupiahToDecimal(besarPinjaman);
            // let bungaTotal =  besarPinjaman;
            let totalBunga = selectedObject.bunga * lamaAngsuran;
            let bunga = selectedObject.bunga;
            let resultPinjaman = selectedObject.jenis_pinjaman;
            let angsuranPerbulan = totalBungaHarusDibayar + rupiahToDecimal(besarPinjaman) / lamaAngsuran;


            document.getElementById('preview-bunga').textContent = totalBunga + '%';
            document.getElementById('preview-jenis-pinjaman').textContent = resultPinjaman;
            document.getElementById('preview-bunga-perbulan').textContent = bunga + '%';
            document.getElementById('preview-angsuran-perbulan').textContent = formatToRupiah(Math.round(angsuranPerbulan));
            document.getElementById('preview-total-bunga-harus-dibayar').textContent = formatToRupiah(totalBungaHarusDibayar);
            document.getElementById('preview-total-bunga-harus-dibayar').textContent = formatToRupiah(totalBungaHarusDibayar);

        }


        // Fungsi untuk mengubah format Rupiah menjadi nilai desimal
        function rupiahToDecimal(rupiah) {
            // Menghapus simbol Rp dan pemisah ribuan (.)
            let cleanValue = rupiah.replace(/\D/g, '');
            // Konversi ke angka desimal
            return parseFloat(cleanValue);
        }

        // function generatePDF() {
        //     var printContent = document.getElementById('document-preview');
        //     var printWindow = window.open('', '_blank');
        //
        //     if (!printWindow) {
        //         alert('Perangkat Anda memblokir jendela pop-up. Mohon izinkan untuk melanjutkan cetak.');
        //         return;
        //     }
        //
        //     printWindow.document.write(printContent.innerHTML);
        //     printWindow.document.write('</body></html>');
        //     // printWindow.document.close();
        //     printWindow.print();
        // }
        function generatePDF() {
            var printContent = document.getElementById('document-preview').innerHTML;
            var iframe = document.createElement('iframe');
            iframe.style.position = 'fixed';
            iframe.style.width = '0';
            iframe.style.height = '0';
            iframe.style.border = 'none';
            document.body.appendChild(iframe);
            var doc = iframe.contentWindow.document;
            doc.open();
            doc.write('<html><head><title>Print Preview</title>');
            doc.write('</head><body>');
            doc.write(printContent);
            doc.write('</body></html>');
            doc.close();
            iframe.contentWindow.focus();
            iframe.contentWindow.print();
            setTimeout(function () {
                document.body.removeChild(iframe);
            }, 1000);
        }

        {{--document.addEventListener("DOMContentLoaded", function () {--}}
        {{--    @if ($errors->any())--}}
        {{--    alert("{{ $errors->first() }}");--}}
        {{--    @endif--}}
        {{--});--}}
        setTimeout(function () {
            $('.alert').alert('close');
            s
        }, 5000);
    </script>

@endsection
