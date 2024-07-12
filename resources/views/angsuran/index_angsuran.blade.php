@extends('layout.master')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Data Angsuran Nasabah</h1>

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
            @if($user->role !== 'anggota')
                <div class="card-header py-3">
                    <div class="row align-items-center">
                        <div class="form-group col-md-4">
                            <label for="peminjam">Pilih Nama Peminjam</label>
                            <select class="custom-select" id="peminjam" name="peminjam">
                                <option value="">Choose...</option>
                                @foreach($nasabah as $peminjam)
                                    <option value="{{ $peminjam->id }}">{{ $peminjam->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-8 text-right">
                            <a href="" id="tambahDataButton"
                               class="btn btn-info btn-icon-split btn-sm d-none">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus-square"></i>
                            </span>
                                <span class="text">Tambah Angsuran</span>
                            </a>
                        </div>

                    </div>
                </div>
            @else
                <input type="hidden" id="peminjam" name="peminjam" value="{{ $user->id }}">
            @endif

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Tanggal Angsuran</th>
                            <th class="text-center">Tanggal Jatuh Tempo</th>
                            <th class="text-center">Angsuran Ke</th>
                            <th class="text-center">Sisa Angsuran</th>
                            <th class="text-center">Angsuran Perbulan</th>
                            <th class="text-center">Denda</th>
                            <th class="text-center">Nominal Angsuran</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Keterangan</th>
                            @if($user->role !== 'anggota')
                                <th class="text-center">Aksi</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody id="angsuranTableBody">
                        <!-- Data akan dimuat di sini -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const peminjamSelect = document.getElementById('peminjam');
            const tambahDataButton = document.getElementById('tambahDataButton');

            if (peminjamSelect.value) {
                loadAngsuranData(peminjamSelect.value);
                tambahDataButton.classList.remove('d-none');
                tambahDataButton.href = `{{ route('angsurans.create') }}?nasabah_id=${peminjamSelect.value}`;
            }

            peminjamSelect.addEventListener('change', function () {
                const peminjamId = this.value;
                if (peminjamId) {
                    loadAngsuranData(peminjamId);

                    tambahDataButton.classList.remove('d-none');
                    tambahDataButton.href = `{{ route('angsurans.create') }}?nasabah_id=${peminjamId}`;
                } else {
                    document.getElementById('angsuranTableBody').innerHTML = '';
                    tambahDataButton.classList.add('d-none');
                    tambahDataButton.href = '#';
                }
            });

            function loadAngsuranData(peminjamId) {
                fetch(`{{ url('angsurans/by-peminjam') }}/${peminjamId}`)
                    .then(response => response.json())
                    .then(data => {
                        const tbody = document.getElementById('angsuranTableBody');
                        tbody.innerHTML = '';
                        let lastAngsuranLunas = false;
                        data.forEach((angsuran, index) => {
                            const editUrl = `{{ url('angsurans') }}/${angsuran.id}/edit`;
                            const deleteUrl = `{{ url('angsurans') }}/${angsuran.id}`;
                            const row = `
                               <tr>
                                <td class="text-center">${index + 1}</td>
                                <td class="text-center">${angsuran.tanggal_angsuran}</td>
                                <td class="text-center">${angsuran.tgl_jatuh_tempo}</td>
                                <td class="text-center">${angsuran.angsuran_ke}</td>
                                <td class="text-center">${angsuran.sisa_angsuran}</td>
                                <td class="text-center">${formatToRupiah(angsuran.angsuran_perbulan)}</td>
                                <td class="text-center">${formatToRupiah(angsuran.denda)}</td>
                                <td class="text-center">${formatToRupiah(angsuran.nominal_angsuran)}</td>
                                <td class="text-center">${angsuran.status_pembayaran}</td>
                                <td class="text-center">${angsuran.keterangan ?? '-'}</td>
                                @if($user->role !== 'anggota')
                            <td class="text-center">
                                <a href="${editUrl}" class="btn btn-primary btn-sm">
                                            Edit
                                        </a>
                                        <form action="${deleteUrl}" method="POST" style="display: inline;">
                                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
@endif
                            </tr>
    `;
                            tbody.insertAdjacentHTML('beforeend', row);
                            if (index === data.length - 1 && angsuran.status_pembayaran === 'Lunas') {
                                lastAngsuranLunas = true;
                            }
                        });
                        // Tambahkan pengecekan untuk tombol tambah angsuran di sini
                        if (lastAngsuranLunas) {
                            tambahDataButton.classList.add('d-none');
                        } else {
                            tambahDataButton.classList.remove('d-none');
                            tambahDataButton.href = `{{ route('angsurans.create') }}?nasabah_id=${peminjamId}`;
                        }
                    });
            }
        });


        function formatToRupiah(value) {
            let reverse = value.toString().split('').reverse().join('');
            let rupiah = reverse.match(/\d{1,3}/g);
            rupiah = rupiah.join('.').split('').reverse().join('');
            return 'Rp ' + rupiah;
        }
    </script>
@endsection
