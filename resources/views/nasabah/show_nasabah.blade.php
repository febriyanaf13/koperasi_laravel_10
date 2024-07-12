@extends('layout.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Detail Pinjaman</h1>

        <div class="card col-md-5 mb-12 py-3 border-left-primary">
            <div class="preview-container" style="padding: 50px">
                <div id="document-preview">
                    <h4 style="padding-bottom: 20px">Data Diri</h4>
                    <div
                        style="display: flex; justify-content: space-between; text-align: justify; padding-bottom: 20px">
                        <strong>Nama :</strong> <span>{{$nasabahs->name}}</span>
                    </div>
                    <div
                        style="display: flex; justify-content: space-between; text-align: justify; padding-bottom: 20px">
                        <strong>NIK :</strong> <span>{{$nasabahs->nik}}</span>
                    </div>

                    <div
                        style="display: flex; justify-content: space-between; text-align: justify; padding-bottom: 20px">
                        <strong>Alamat :</strong> <span>{{$nasabahs->user->alamat}}</span>
                    </div>

                    <h4 style="margin-top: 30px; padding-bottom: 20px">Detail Pinjaman</h4>
                    <div
                        style="display: flex; justify-content: space-between; text-align: justify; padding-bottom: 20px">
                        <strong>Jenis Pinjaman :</strong><span>{{$nasabahs->jenis_pinjaman}}</span></div>
                    <div
                        style="display: flex; justify-content: space-between; text-align: justify; padding-bottom: 20px">
                        <strong>Besar Pinjaman :</strong> <span
                            id="besar_pinjaman"></span></div>
                    <div
                        style="display: flex; justify-content: space-between; text-align: justify; padding-bottom: 20px">
                        <strong>Bunga :</strong> <span></span>{{$nasabahs->bunga}} %
                    </div>
                    <div
                        style="display: flex; justify-content: space-between; text-align: justify; padding-bottom: 20px">
                        <strong>Tipe Bunga :</strong> <span>{{$nasabahs->tipe_bunga}}</span></div>
                    <div
                        style="display: flex; justify-content: space-between; text-align: justify; padding-bottom: 20px">
                        <strong>Bunga Perbulan :</strong> <span>{{$nasabahs->bunga_perbulan}} %</span></div>
                    <div
                        style="display: flex; justify-content: space-between; text-align: justify; padding-bottom: 20px">
                        <strong>Angsuran Perbulan :</strong> <span id="angsuran_perbulan"></span></div>
                    <div
                        style="display: flex; justify-content: space-between; text-align: justify; padding-bottom: 20px">
                        <strong>Lama Angsuran :</strong> <span>{{$nasabahs->lama_angsuran}} Bulan</span></div>
                    <div
                        style="display: flex; justify-content: space-between; text-align: justify; padding-bottom: 20px">
                        <strong>Total
                            Bunga Harus Dibayar :</strong> <span id="total_bunga_harus_dibayar"></span>
                    </div>

                </div>
            </div>


        </div>


    </div>

    <script>
        function formatRupiah(angka, prefix) {
            var numberString = angka.toString().replace(/[^,\d]/g, '').toString(),
                split = numberString.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                var separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
        }

        function updateRupiah() {
            document.getElementById('besar_pinjaman').innerText = formatRupiah({{$nasabahs->besar_pinjaman}}, 'Rp ');
            document.getElementById('angsuran_perbulan').innerText = formatRupiah({{$nasabahs->angsuran_perbulan}}, 'Rp ');
            document.getElementById('total_bunga_harus_dibayar').innerText = formatRupiah({{$nasabahs->total_bunga_harus_dibayar}}, 'Rp ');
        }

        window.onload = updateRupiah;
    </script>
    <!-- /.container-fluid -->

@endsection
