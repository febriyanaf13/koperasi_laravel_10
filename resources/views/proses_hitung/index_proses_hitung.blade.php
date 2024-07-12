@extends('layout.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Kalkulator Bunga Pinjaman -->
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Hitung Bunga Pinjaman</h6>
                    </div>
                    <div class="card-body">
                        <form id="bungaForm">
                            <div class="form-group">
                                <label for="principal">Jumlah Pinjaman (Rp)</label>
                                <input type="number" class="form-control" id="principal" name="principal"
                                       placeholder="Masukkan jumlah pinjaman">
                            </div>
                            <div class="form-group">
                                <label for="rate">Bunga per Bulan (%)</label>
                                <input type="number" class="form-control" id="rate" name="rate"
                                       placeholder="Masukkan bunga per bulan">
                            </div>
                            <div class="form-group">
                                <label for="time">Jangka Waktu (bulan)</label>
                                <input type="number" class="form-control" id="time" name="time"
                                       placeholder="Masukkan jangka waktu pinjaman dalam bulan">
                            </div>
                            <button type="button" class="btn btn-primary" onclick="calculateInterest()">Hitung</button>
                        </form>

                        <!-- Result Section -->
                        <div class="mt-4">
                            <h5>Hasil Perhitungan:</h5>
                            <div id="result">
                                <p>Hasil perhitungan bunga akan tampil di sini.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Perhitungan Laba Rugi -->
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Perhitungan Laba Rugi</h6>
                    </div>
                    <div class="card-body">
                        <form id="labaRugiForm">
                            <div class="form-group">
                                <label for="pendapatan">Total Pendapatan (Rp)</label>
                                <input type="number" class="form-control" id="pendapatan" name="pendapatan"
                                       placeholder="Masukkan total pendapatan">
                            </div>
                            <div class="form-group">
                                <label for="biaya">Total Biaya (Rp)</label>
                                <input type="number" class="form-control" id="biaya" name="biaya"
                                       placeholder="Masukkan total biaya">
                            </div>
                            <button type="button" class="btn btn-primary" onclick="calculateProfitLoss()">Hitung</button>
                        </form>

                        <!-- Result Section -->
                        <div class="mt-4">
                            <h5>Hasil Perhitungan Laba Rugi:</h5>
                            <div id="resultProfitLoss">
                                <p>Hasil perhitungan laba rugi akan tampil di sini.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Perhitungan SHU -->
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Perhitungan Sisa Hasil Usaha (SHU)</h6>
                    </div>
                    <div class="card-body">
                        <form id="shuForm">
                            <div class="form-group">
                                <label for="totalPendapatan">Total Pendapatan (Rp)</label>
                                <input type="number" class="form-control" id="totalPendapatan" name="totalPendapatan"
                                       placeholder="Masukkan total pendapatan">
                            </div>
                            <div class="form-group">
                                <label for="totalBiayaOperasional">Total Biaya Operasional (Rp)</label>
                                <input type="number" class="form-control" id="totalBiayaOperasional"
                                       name="totalBiayaOperasional" placeholder="Masukkan total biaya operasional">
                            </div>
                            <div class="form-group">
                                <label for="totalPenyisihan">Total Penyisihan Penghapusan Aset (Rp)</label>
                                <input type="number" class="form-control" id="totalPenyisihan" name="totalPenyisihan"
                                       placeholder="Masukkan total penyisihan penghapusan aset">
                            </div>
                            <button type="button" class="btn btn-primary" onclick="calculateSHU()">Hitung</button>
                        </form>

                        <!-- Result Section -->
                        <div class="mt-4">
                            <h5>Hasil Perhitungan SHU:</h5>
                            <div id="resultSHU">
                                <p>Hasil perhitungan SHU akan tampil di sini.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function calculateInterest() {
            const principal = parseFloat(document.getElementById('principal').value);
            const ratePerMonth = parseFloat(document.getElementById('rate').value);
            const time = parseFloat(document.getElementById('time').value);

            if (!isNaN(principal) && !isNaN(ratePerMonth) && !isNaN(time)) {
                const interest = (principal * ratePerMonth * time) / 100;
                const totalAmount = principal + interest;

                const interestExplanation = `
                <p>Jumlah Pinjaman: Rp ${principal.toLocaleString()}</p>
                <p>Bunga per Bulan: ${ratePerMonth}%</p>
                <p>Jangka Waktu: ${time} bulan</p>
                <p>Bunga yang Dihasilkan: Rp ${interest.toLocaleString()}</p>
                <p>Total yang Harus Dibayar: Rp ${totalAmount.toLocaleString()}</p>
                <hr>
                <h5>Penggambaran Perhitungan Bunga Pinjaman:</h5>
                <p>
                    Bunga yang dihasilkan dihitung dengan rumus: <br>
                    <strong>Bunga = Jumlah Pinjaman x Bunga per Bulan x Jangka Waktu (dalam bulan)</strong><br>
                    Jadi, <br>
                    <strong>Bunga = Rp ${principal.toLocaleString()} x ${ratePerMonth}% x ${time} bulan</strong><br>
                    <strong>Bunga = Rp ${interest.toLocaleString()}</strong>
                </p>
                <p>
                    Total yang harus dibayar dihitung dengan menambahkan jumlah pinjaman dengan bunga yang dihasilkan: <br>
                    <strong>Total = Jumlah Pinjaman + Bunga</strong><br>
                    Jadi, <br>
                    <strong>Total = Rp ${principal.toLocaleString()} + Rp ${interest.toLocaleString()}</strong><br>
                    <strong>Total = Rp ${totalAmount.toLocaleString()}</strong>
                </p>
            `;

                document.getElementById('result').innerHTML = interestExplanation;
            } else {
                document.getElementById('result').innerHTML = "<p>Tolong isi semua bidang dengan benar!</p>";
            }
        }

        function calculateProfitLoss() {
            const pendapatan = parseFloat(document.getElementById('pendapatan').value);
            const biaya = parseFloat(document.getElementById('biaya').value);

            if (!isNaN(pendapatan) && !isNaN(biaya)) {
                const labaRugi = pendapatan - biaya;

                const profitLossExplanation = `
                <p>Total Pendapatan: Rp ${pendapatan.toLocaleString()}</p>
                <p>Total Biaya: Rp ${biaya.toLocaleString()}</p>
                <p>Laba Rugi: Rp ${labaRugi.toLocaleString()}</p>
                <hr>
                <h5>Penggambaran Perhitungan Laba Rugi:</h5>
                <p>
                    Laba rugi dihitung dengan mengurangi total biaya dari total pendapatan: <br>
                    <strong>Laba Rugi = Total Pendapatan - Total Biaya</strong><br>
                    Jadi, <br>
                    <strong>Laba Rugi = Rp ${pendapatan.toLocaleString()} - Rp ${biaya.toLocaleString()}</strong><br>
                    <strong>Laba Rugi = Rp ${labaRugi.toLocaleString()}</strong>
                </p>
            `;

                document.getElementById('resultProfitLoss').innerHTML = profitLossExplanation;
            } else {
                document.getElementById('resultProfitLoss').innerHTML = "<p>Tolong isi semua bidang dengan benar!</p>";
            }
        }

        function calculateSHU() {
            const totalPendapatan = parseFloat(document.getElementById('totalPendapatan').value);
            const totalBiayaOperasional = parseFloat(document.getElementById('totalBiayaOperasional').value);
            const totalPenyisihan = parseFloat(document.getElementById('totalPenyisihan').value);

            if (!isNaN(totalPendapatan) && !isNaN(totalBiayaOperasional) && !isNaN(totalPenyisihan)) {
                const shu = totalPendapatan - totalBiayaOperasional - totalPenyisihan;

                const shuExplanation = `
                <p>Total Pendapatan: Rp ${totalPendapatan.toLocaleString()}</p>
                <p>Total Biaya Operasional: Rp ${totalBiayaOperasional.toLocaleString()}</p>
                <p>Total Penyisihan Penghapusan Aset: Rp ${totalPenyisihan.toLocaleString()}</p>
                <p>Sisa Hasil Usaha (SHU): Rp ${shu.toLocaleString()}</p>
                <hr>
                <h5>Penggambaran Perhitungan SHU:</h5>
                <p>
                    SHU dihitung dengan mengurangi total biaya operasional dan total penyisihan dari total pendapatan: <br>
                    <strong>SHU = Total Pendapatan - Total Biaya Operasional - Total Penyisihan</strong><br>
                    Jadi, <br>
                    <strong>SHU = Rp ${totalPendapatan.toLocaleString()} - Rp ${totalBiayaOperasional.toLocaleString()} - Rp ${totalPenyisihan.toLocaleString()}</strong><br>
                    <strong>SHU = Rp ${shu.toLocaleString()}</strong>
                </p>
            `;

                document.getElementById('resultSHU').innerHTML = shuExplanation;
            } else {
                document.getElementById('resultSHU').innerHTML = "<p>Tolong isi semua bidang dengan benar!</p>";
            }
        }
    </script>

@endsection
