<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Sinar<span>Nadi</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Menu Utama</li>
            <li class="nav-item {{ active_class(['/']) }}">
                <a href="{{ url('/') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item nav-category">Web App</li>

            <li class="nav-item {{ active_class(['attendance/*']) }}">
                <a class="nav-link" data-toggle="collapse" href="#attendance" role="button"
                    aria-expanded="{{ is_active_route(['attendance/*']) }}" aria-controls="attendance">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">Absensi</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['attendance/employee-attendance-list/*']) }}" id="attendance">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('/attendance/employee-attendance-list') }}"
                                class="nav-link {{ active_class(['attendance/attendance']) }}">
                                Daftar Absensi Karyawan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/attendance/branch-employee') }}"
                                class="nav-link {{ active_class(['attendance/attendance']) }}">
                                Absensi Karyawan
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item {{ active_class(['datamaster/*']) }}">
                <a class="nav-link" data-toggle="collapse" href="#datamaster" role="button"
                    aria-expanded="{{ is_active_route(['datamaster/*']) }}" aria-controls="datamaster">
                    <i class="link-icon" data-feather="feather"></i>
                    <span class="link-title">Master Data</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['datamaster/*']) }}" id="datamaster">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('/datamaster/branch') }}"
                                class="nav-link {{ active_class(['datamaster/branch']) }}">Toko Cabang</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/datamaster/user') }}"
                                class="nav-link {{ active_class(['datamaster/user']) }}">Pengguna</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/datamaster/working-hour') }}"
                                class="nav-link {{ active_class(['datamaster/work-hour']) }}">Waktu Pergantian Shift</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
