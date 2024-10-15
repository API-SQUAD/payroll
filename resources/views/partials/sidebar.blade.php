<nav id="sidebar">
    <div class="sidebar-content">
        <div class="content-header content-header-fullrow px-15">
            <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                <div class="content-header-item">
                    <img src="{{ asset('media/logo/logo_arita.png') }}" width="45%">
                </div>
            </div>
        </div>
        <div class="content-side content-side-full">
            <ul class="nav-main nav-link active">
                <li>
                    <a class="{{ request()->routeIs('dashboard*') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i
                            class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                </li>

                <li class="nav-main-heading">
                    <span class="sidebar-mini-hidden">Payroll</span>
                </li>
                <li>
                    <a class="<?= (strpos($_SERVER['REQUEST_URI'], 'gaji')) ? 'active' : '' ?>"
                        href="{{ route('gaji.index') }}"><i class="fa fa-lock"></i><span
                            class="sidebar-mini-hide">ARSIP</span></a>
                </li>

                <li class="nav-main-heading">
                    <span class="sidebar-mini-hidden">Karyawan</span>
                </li>
                <li>
                    <a class="<?= (strpos($_SERVER['REQUEST_URI'], 'resign')) ? 'active' : '' ?>"
                        href="{{ route('resign.index') }}"><i class="fa fa-user-times"></i><span
                            class="sidebar-mini-hide">Resign</span></a>
                </li>

                <li class="nav-main-heading">
                    <span class="sidebar-mini-hidden">Data Master</span>
                </li>
                <li>
                    <a class="<?= (strpos($_SERVER['REQUEST_URI'], 'data_karyawan')) ? 'active' : '' ?>"
                        href="../data_karyawan/index.php"><i class="fa fa-users"></i><span
                            class="sidebar-mini-hide">Data Karyawan</span></a>
                </li>
                <li>
                    <a class="<?= (strpos($_SERVER['REQUEST_URI'], 'data_jabatan')) ? 'active' : '' ?>"
                        href="../data_jabatan/index.php"><i class="fa fa-black-tie"></i><span
                            class="sidebar-mini-hide">Data Jabatan</span></a>
                </li>
                <li>
                    <a class="<?= (strpos($_SERVER['REQUEST_URI'], 'data_cabang')) ? 'active' : '' ?>"
                        href="../data_cabang/index.php"><i class="fa fa-building"></i><span
                            class="sidebar-mini-hide">Data Cabang</span></a>
                </li>

                <li class="nav-main-heading">
                    <span class="sidebar-mini-hidden">Setting</span>
                </li>
                <li>
                    <a class="{{ request()->routeIs('users*') ? 'active' : '' }}" href="{{ route('users.index') }}"><i
                            class="fa fa-gear"></i><span class="sidebar-mini-hide">User</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>