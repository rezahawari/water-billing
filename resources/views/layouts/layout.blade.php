@php
    use Laravolt\Avatar\Avatar;

    $avatar = new Avatar();
    $avatar->create(Auth::user()->nama)->toBase64();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sumber Tirta - Aplikasi Pengelolaan Air Bersih</title>
    <link rel="icon" type="image/x-icon" href="{{asset('temp/src/assets/img/favicon.ico')}}"/>
    <link href="{{asset('temp/layouts/vertical-light-menu/css/light/loader.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('temp/layouts/vertical-light-menu/css/dark/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('temp/layouts/vertical-light-menu/loader.js')}}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('temp/src/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('temp/layouts/vertical-light-menu/css/light/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('temp/layouts/vertical-light-menu/css/dark/plugins.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('temp/src/assets/css/light/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('temp/src/assets/css/dark/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <!-- toastr -->
    <link href="{{asset('temp/src/plugins/src/notification/snackbar/snackbar.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('temp/src/plugins/css/light/notification/snackbar/custom-snackbar.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('temp/src/plugins/css/dark/notification/snackbar/custom-snackbar.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{asset('temp/src/plugins/src/sweetalerts2/sweetalerts2.css')}}">

    <link href="{{asset('temp/src/assets/css/light/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('temp/src/plugins/css/light/sweetalerts2/custom-sweetalert.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('temp/src/assets/css/dark/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('temp/src/plugins/css/dark/sweetalerts2/custom-sweetalert.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    @yield('style')
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

</head>
<body class="layout-boxed">
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <div class="header-container container-xxl">
        <header class="header navbar navbar-expand-sm expand-header">

            <a href="javascript:void(0);" class="sidebarCollapse">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
            </a>

            {{-- <div class="search-animated toggle-search">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <form class="form-inline search-full form-inline search" role="search">
                    <div class="search-bar">
                        <input type="text" class="form-control search-form-control  ml-lg-auto" placeholder="Search...">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x search-close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </div>
                </form>
                <span class="badge badge-secondary">Ctrl + /</span>
            </div> --}}

            <ul class="navbar-item flex-row ms-lg-auto ms-0">

                <li class="nav-item theme-toggle-item">
                    <a href="javascript:void(0);" class="nav-link theme-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-moon dark-mode"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sun light-mode"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
                    </a>
                </li>



                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar-container">
                            <div class="avatar avatar-sm">
                                <img alt="avatar" src="{{$avatar}}" class="rounded-circle">
                            </div>
                        </div>
                    </a>

                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <div class="user-profile-section">
                            <div class="media mx-auto">
                                <div class="emoji me-2">
                                    &#x1F44B;
                                </div>
                                <div class="media-body">
                                    <h5>{{Auth::user()->nama}}</h5>
                                    @if (Auth::user()->role == 1)
                                        <p>Super Admin</p>
                                    @endif
                                    @if (Auth::user()->role == 2)
                                        <p>Admin</p>
                                    @endif
                                    @if (Auth::user()->role == 3)
                                        <p>Petugas</p>
                                    @endif

                                </div>
                            </div>
                        </div>
                        {{-- <div class="dropdown-item">
                            <a href="user-profile.html">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> <span>Profile</span>
                            </a>
                        </div> --}}
                        {{-- <div class="dropdown-item">
                            <a href="auth-boxed-lockscreen.html">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg> <span>Lock Screen</span>
                            </a>
                        </div> --}}
                        <!-- Tombol Logout -->
                        <div class="dropdown-item">
                            <a href="{{ route('keluar') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-log-out">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                            <span>Log Out</span>
                            </a>
                        </div>

                        <!-- Form logout tersembunyi -->
                        <form id="logout-form" action="{{ route('keluar') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>

                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">

            <nav id="sidebar">

                <div class="navbar-nav theme-brand flex-row  text-center">
                    <div class="nav-logo">
                        <div class="nav-item theme-text">
                            <a href="./index.html" class="nav-link"> Sumber Tirta </a>
                        </div>
                    </div>
                    <div class="nav-item sidebar-toggle">
                        <div class="btn-toggle sidebarCollapse">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg>
                        </div>
                    </div>
                </div>

                <div class="profile-info">
                    <div class="user-info">
                        <div class="profile-img">
                            <img src="{{ $avatar}}" alt="avatar">
                        </div>
                        <div class="profile-content">
                            <h6 class="">{{Auth::user()->nama}}</h6>
                            @if (Auth::user()->role == 1)
                                <p>Super Admin</p>
                            @endif
                            @if (Auth::user()->role == 2)
                                <p>Admin</p>
                            @endif
                            @if (Auth::user()->role == 3)
                                <p>Petugas</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="shadow-bottom"></div>
                <ul class="list-unstyled menu-categories" id="accordionExample">
                    <li class="menu {{ request()->is('/') ? 'active' : '' }}">
                        <a href="{{route('dashboard')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>
                    @php
                        $catatRoutes = ['catat'];
                        $isCatatActive = in_array(request()->route()->getName(), $catatRoutes);
                    @endphp
                    <li class="menu {{ $isCatatActive ? 'active' : '' }}">
                        <a href="{{route('catat')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                <span>Catat Penggunaan</span>
                            </div>
                        </a>
                    </li>
                    @php
                        $catatRoutes = ['tagihan', 'tagihan.show'];
                        $isCatatActive = in_array(request()->route()->getName(), $catatRoutes);
                    @endphp
                    <li class="menu {{ $isCatatActive ? 'active' : '' }}">
                        <a href="{{route('tagihan')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                <span>Tagihan</span>
                            </div>
                        </a>
                    </li>
                    @php
                        $laporanRoutes = ['penggunaan', 'tunggakan'];
                        $isLaporanActive = in_array(request()->route()->getName(), $laporanRoutes);
                    @endphp
                    <li class="menu {{ $isLaporanActive ? 'active' : '' }}" id="sidebar-item">
                        <a href="#laporan" data-bs-toggle="collapse" aria-expanded="{{ $isLaporanActive ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                <span>Laporan</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ $isLaporanActive ? 'show' : '' }}" id="laporan" data-bs-parent="#accordionExample">
                            <li class="{{ request()->is('penggunaan') ? 'active' : '' }}">
                                <a href="{{route('penggunaan')}}"> Daftar Penggunaan </a>
                            </li>
                            <li class="{{ request()->is('tunggakan') ? 'active' : '' }}">
                                <a href="{{route('tunggakan')}}"> Daftar Tunggakan </a>
                            </li>
                        </ul>
                    </li>
                    @php
                        $pelangganRoutes = ['customer.all', 'customer.allshow'];
                        $isPelangganActive = in_array(request()->route()->getName(), $pelangganRoutes);
                    @endphp
                    <li class="menu {{ $isPelangganActive ? 'active' : '' }}" id="sidebar-item">
                        <a href="#pelanggan" data-bs-toggle="collapse" aria-expanded="{{ $isPelangganActive ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                <span>Pelanggan</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ $isPelangganActive ? 'show' : '' }}" id="pelanggan" data-bs-parent="#accordionExample">
                            <li class="{{ request()->is('pelanggan') ? 'active' : '' }}">
                                <a href="{{route('customer.all')}}"> Semua Pelanggan </a>
                            </li>
                        </ul>
                    </li>
                    @php
                        $settingsRoutes = ['tarif', 'alamat', 'users'];
                        $isSettingsActive = in_array(request()->route()->getName(), $settingsRoutes);
                    @endphp
                    <li class="menu {{ $isSettingsActive ? 'active' : '' }}" id="sidebar-item">
                        <a href="#settings" data-bs-toggle="collapse" aria-expanded="{{ $isSettingsActive ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                                <span>Settings</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ $isSettingsActive ? 'show' : '' }}" id="settings" data-bs-parent="#accordionExample">
                            <li class="{{ request()->is('tarif') ? 'active' : '' }}">
                                <a href="{{route('tarif')}}"> Tarif </a>
                            </li>
                            <li class="{{ request()->is('alamat') ? 'active' : '' }}">
                                <a href="{{route('alamat')}}"> Alamat </a>
                            </li>
                            <li class="{{ request()->is('users') ? 'active' : '' }}">
                                <a href="{{route('users')}}"> Users </a>
                            </li>
                        </ul>
                    </li>

                </ul>

            </nav>

        </div>
        <!--  END SIDEBAR  -->

        @yield('content')

    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('temp/src/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('temp/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('temp/src/plugins/src/mousetrap/mousetrap.min.js')}}"></script>
    <script src="{{asset('temp/src/plugins/src/waves/waves.min.js')}}"></script>
    <script src="{{asset('temp/layouts/vertical-light-menu/app.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="{{asset('temp/src/assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset('temp/src/plugins/src/notification/snackbar/snackbar.min.js')}}"></script>
    <script src="{{asset('temp/src/assets/js/components/notification/custom-snackbar.js')}}"></script>
    <script src="{{asset('temp/src/assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset('temp/src/plugins/src/sweetalerts2/sweetalerts2.min.js')}}"></script>
    <script src="{{asset('temp/src/plugins/src/sweetalerts2/custom-sweetalert.js')}}"></script>
    <script>
        window.onload = function() {
            // Ambil URL saat ini
            var currentURL = window.location.hash;

            // Seleksi elemen sidebar item
            var sidebarItem = document.getElementById('sidebar-item');
            var liItem = document.getElementById('settings');
            var link = sidebarItem.querySelector('a');

            // Jika URL cocok dengan href, tambahkan kelas 'active' dan set 'aria-expanded' menjadi 'true'
            if (currentURL === '#users') {
                sidebarItem.classList.add('active');
                liItem.classList.add('show');
                link.setAttribute('aria-expanded', 'true');
            }
        };
    </script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    @yield('script')

    @if(session('success'))
        <script>
            // Gunakan json_encode untuk menghindari masalah karakter khusus
            Snackbar.show({
                text: {!! json_encode(session('success')) !!},  // Menangani teks dengan benar
                pos: 'top-center',
                backgroundColor: '#3eb300'
            });
        </script>
    @endif
    @if(session('fail'))
        <script>
            // Gunakan json_encode untuk menghindari masalah karakter khusus
            Snackbar.show({
                text: {!! json_encode(session('fail')) !!},  // Menangani teks dengan benar
                pos: 'top-center',
                backgroundColor: '#cf0000'
            });
        </script>
    @endif

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

</body>
</html>
