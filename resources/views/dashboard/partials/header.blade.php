    <div class="main-header">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="blue">

            <a href="/dashboard" class="logo">
                {{-- <img src="{{ asset('/vendor/template/img/logo.svg') }}" alt="navbar brand" class="navbar-brand"> --}}
                <p class="text-light h2 py-3">Encrypted RFID</p>
            </a>
            <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <i class="icon-menu"></i>
                </span>
            </button>
            <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="icon-menu"></i>
                </button>
            </div>
        </div>
        <!-- End Logo Header -->

        <!-- Navbar Header -->
        <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

            <div class="container-fluid">
                <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                    <li class="nav-item dropdown hidden-caret">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                            <div class="avatar-sm">
                                <img src="{{ asset('vendor/template/img/profile.jpg') }}" alt="..."
                                    class="avatar-img rounded-circle">
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-user animated fadeIn">
                            <div class="dropdown-user-scroll scrollbar-outer">
                                <li>
                                    @auth
                                        <div class="user-box">
                                            <div class="avatar-lg"><img
                                                    src="{{ asset('vendor/template/img/profile.jpg') }}" alt="image profile"
                                                    class="avatar-img rounded"></div>
                                            <div class="u-text">
                                                <h4>{{ auth()->user()->name }} - {{ auth()->user()->role }}</h4>
                                                <p class="text-muted">{{ auth()->user()->email }}</p>
                                                @can('isAdmin')
                                                <a href="/admin/users/{{ auth()->user()->id }}/edit" class="btn btn-xs btn-secondary btn-sm">Edit Profile</a>
                                                @endcan
                                            </div>
                                        </div>
                                    @endauth
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                    <form action="/logout" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Keluar</button>
                                    </form>
                                    {{-- <a class="dropdown-item" href="#">Logout</a> --}}
                                </li>
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- End Navbar -->
    </div>
