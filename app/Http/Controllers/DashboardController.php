<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\Saldo;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalUsers = User::count();
        $totalNasabah = Nasabah::count();
        $totalSaldo = Saldo::sum('jumlah');
        $totalPinjaman = Nasabah::sum('besar_pinjaman');

        // Menjumlahkan uang masuk
        $totalMasuk = Transaksi::where('jenis', 'masuk')->sum('nominal');
        // Menjumlahkan uang keluar
        $totalKeluar = Transaksi::where('jenis', 'keluar')->sum('nominal');


        return view('/dashboard/dashboard', compact('totalUsers', 'totalNasabah', 'totalSaldo', 'totalPinjaman', 'totalMasuk', 'totalKeluar'));
    }

    public function getNasabahData(): JsonResponse
    {
        $year = Carbon::now()->year;

        $nasabahCounts = Nasabah::selectRaw('COUNT(*) as count, EXTRACT(MONTH FROM tanggal_pinjaman) as month')
            ->whereYear('tanggal_pinjaman', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = [];
        $data = [];

        foreach ($nasabahCounts as $nasabahCount) {
            $labels[] = Carbon::create()->month($nasabahCount->month)->format('F');
            $data[] = $nasabahCount->count;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
        // Data statis untuk keperluan demo. Anda bisa menggantinya dengan data dari database.
//        $data = [
//            ['month' => 'January', 'count' => 10],
//            ['month' => 'February', 'count' => 20],
//            ['month' => 'March', 'count' => 30],
//            ['month' => 'April', 'count' => 40],
//            ['month' => 'May', 'count' => 50],
//            ['month' => 'June', 'count' => 60],
//            ['month' => 'July', 'count' => 70],
//            ['month' => 'August', 'count' => 80],
//            ['month' => 'September', 'count' => 90],
//            ['month' => 'October', 'count' => 100],
//            ['month' => 'November', 'count' => 110],
//            ['month' => 'December', 'count' => 120],
//        ];
//
//        return response()->json($data);
    }
}
