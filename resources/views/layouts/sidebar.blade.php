<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">
                    Menu
                </li>
                <li>
                    <a href="/dashboard">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/mahasiswa">
                        <i class="mdi mdi-account-group"></i>
                        <span>Mahasiswa</span>
                    </a>
                </li>
                <li>
                    <a href="/survey">
                        <i class="mdi mdi-clipboard-text"></i>
                        <span>Survey</span>
                    </a>
                </li>
                <li>
                    <a href="/laporan">
                        <i class="mdi mdi-file-chart"></i>
                        <span>Laporan</span>
                    </a>
                </li>
                <li>

                    <a href="javascript: void(0);" class="has-arrow">

                        <i class="mdi mdi-file-chart"></i>

                        <span>Laporan Akreditasi</span>

                    </a>

                    <ul class="sub-menu">

                        <li>
                            <a href="{{ route('laporan.dosen') }}">
                                Laporan Dosen
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('laporan.prodi') }}">
                                Laporan Prodi
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('laporan.servqual') }}">
                                Laporan SERVQUAL
                            </a>
                        </li>

                    </ul>

                </li>
            </ul>
        </div>
    </div>
</div>
