    <!-- Sidebar -->
    <div class="sidebar sidebar-style-2">
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <ul class="nav nav-primary">
                    <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                        <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="dashboard">
                            <ul class="nav nav-collapse">
                                <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                                    <a href="/dashboard">
                                        <span class="sub-item">Log History</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">List Menu Door-Lock</h4>
                    </li>
                        <li class="nav-item {{ Request::is('dashboard/*') ? 'active' : '' }}">
                            <a data-toggle="collapse" href="#submenu">
                                <i class="fas fa-bars"></i>
                                <p>Menu Door-Lock</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="submenu">
                                <ul class="nav nav-collapse">
                                    @can('isStaff')
                                        <li class="{{ Request::is('dashboard/userinfo*') ? 'active' : '' }}">
                                            <a href="/dashboard/userinfo">
                                                <span class="sub-item">Informasi Pengguna Kartu RFID</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('isAdmin')
                                        <li class="{{ Request::is('dashboard/user-info*') ? 'active' : '' }}">
                                            <a href="/dashboard/user-info">
                                                <span class="sub-item">Informasi Pengguna Kartu RFID</span>
                                            </a>
                                        </li>
                                        <li class="{{ Request::is('dashboard/user-card*') ? 'active' : '' }}">
                                            <a href="/dashboard/user-card">
                                                <span class="sub-item">Kartu RFID</span>
                                            </a>
                                        </li>
                                        <li class="{{ Request::is('dashboard/device*') ? 'active' : '' }}">
                                            <a href="/dashboard/device">
                                                <span class="sub-item">Perangkat DoorLock RFID</span>
                                            </a>
                                        </li>
                                        <li class="{{ Request::is('dashboard/userlog*') ? 'active' : '' }}">
                                            <a href="/dashboard/userlog">
                                                <span class="sub-item">Histori Pengguna RFID</span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                        @can('isAdmin')
                            <li class="nav-section">
                                <span class="sidebar-mini-icon">
                                    <i class="fa fa-user-h"></i>
                                </span>
                                <h4 class="text-section">List Menu Admin</h4>
                            </li>
                            <li class="nav-item {{ Request::is('admin/*') ? 'active' : '' }}">
                                <a data-toggle="collapse" href="#submenu2">
                                    <i class="fas fa-bars"></i>
                                    <p>Menu Admin</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="submenu2">
                                    <ul class="nav nav-collapse">
                                        <li class="{{ Request::is('admin/users*') ? 'active' : '' }}">
                                            <a href="/admin/users">
                                                <span class="sub-item">Informasi Akun Website Pengguna</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endcan
                </ul>
            </div>
        </div>
    </div>
    <!-- End Sidebar -->
