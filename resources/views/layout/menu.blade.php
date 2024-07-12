<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-donate"></i>
        </div>
        <div class="sidebar-brand-text mx-3">KOPERASI</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @if (Auth::user()->role === 'admin')
        <!-- Menu Admin -->

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ Route::is('dashboard.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item {{ Route::is('users.index') ? 'active' : '' }}">
            <a class="nav-link " href="{{ route ('users.index') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>Data Pengguna</span>
            </a>
        </li>
        <li class="nav-item {{ Route::is('nasabah.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route ('nasabah.index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Data Pinjaman Nasabah</span>
            </a>
        </li>
        <li class="nav-item {{ Route::is('jenis_pinjaman.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{route('jenis_pinjaman.index')}}">
                <i class="fas fa-fw fa-list-alt"></i>
                <span>Data Jenis Pinjaman</span>
            </a>
        </li>
        <li class="nav-item {{ Route::is('transaksis.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{route('transaksis.index')}}">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Data Transaksi</span>
            </a>
        </li>
        <li class="nav-item {{ Route::is('angsurans.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{route('angsurans.index')}}">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Data Angsuran</span>
            </a>
        </li>
        <li class="nav-item {{ Route::is('laporans.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{route('laporans.index')}}">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Laporan</span>
            </a>
        </li>
        <li class="nav-item {{ Route::is('proses_hitungs.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{route('proses_hitungs.index')}}">
                <i class="fas fa-fw fa-calculator"></i>
                <span>Proses Hitung</span>
            </a>
        </li>
    @endif

    @if (Auth::user()->role === 'operator')
        <!-- Menu Operator -->
        <!-- Nav Item - Dashboard -->

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ Route::is('dashboard.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item {{ Route::is('users.index') ? 'active' : '' }}">
            <a class="nav-link " href="{{ route ('users.index') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>Data Pengguna</span>
            </a>
        </li>
        <li class="nav-item {{ Route::is('nasabah.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route ('nasabah.index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Data Pinjaman Nasabah</span>
            </a>
        </li>

        <li class="nav-item {{ Route::is('transaksis.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{route('transaksis.index')}}">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Data Transaksi</span>
            </a>
        </li>
        <li class="nav-item {{ Route::is('angsurans.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{route('angsurans.index')}}">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Data Angsuran</span>
            </a>
        </li>
        <li class="nav-item {{ Route::is('laporans.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{route('laporans.index')}}">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Laporan</span>
            </a>
        </li>

        <!-- Tambahkan menu lainnya untuk Operator -->
    @endif

    @if (Auth::user()->role === 'anggota')
        <!-- Menu Anggota -->
        <!-- Nav Item - Dashboard -->

        <li class="nav-item {{ Route::is('angsurans.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{route('angsurans.index')}}">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Data Angsuran</span>
            </a>
        </li>
        <!-- Tambahkan menu lainnya untuk Anggota -->
    @endif
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
