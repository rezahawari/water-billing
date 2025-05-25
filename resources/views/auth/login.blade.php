<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Login - Aplikasi Pembayaran Pengelolaan Air Bersih </title>
    <link rel="icon" type="image/x-icon" href="{{asset('temp/src/assets/img/favicon.ico')}}"/>
    <link href="{{asset('temp/layouts/vertical-light-menu/css/light/loader.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('temp/layouts/vertical-light-menu/css/dark/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('temp/layouts/vertical-light-menu/loader.js')}}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('temp/src/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('temp/layouts/vertical-light-menu/css/light/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('temp/src/assets/css/light/authentication/auth-cover.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('temp/layouts/vertical-light-menu/css/dark/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('temp/src/assets/css/dark/authentication/auth-cover.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
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

</head>
<body class="form">

    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <div class="auth-container d-flex">

        <div class="container mx-auto align-self-center">

            <div class="row">

                <div class="col-6 d-lg-flex d-none h-100 my-auto top-0 start-0 text-center justify-content-center flex-column">
                    <div class="auth-cover-bg-image"></div>
                    <div class="auth-overlay"></div>

                    <div class="auth-cover">

                        <div class="position-relative">

                            <img src="{{asset('temp/src/assets/img/auth-cover.svg')}}" alt="auth-img">

                            {{-- <h2 class="mt-5 text-white font-weight-bolder px-2">Join the community of expert developers</h2>
                            <p class="text-white px-2">It is easy to setup with great customer experience. Start your 7-day free trial</p> --}}
                        </div>

                    </div>

                </div>

                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center ms-lg-auto me-lg-0 mx-auto">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12 mb-3">

                                    <h2>SELAMAT DATANG</h2>
                                    <p>Masukkan username dan password anda</p>

                                </div>
                            <form action="/masuk" method="post">
                                @csrf
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input class="form-control" id="username" type="text" name="username" value="{{ old('username') }}" required autofocus>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label class="form-label">Password</label>
                                        <input class="form-control" id="password" type="password" name="password" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-4">
                                        <button type="submit" class="btn btn-secondary w-100">MASUK</button>
                                    </div>
                                </div>
                            </form>

                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('temp/src/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('temp/src/assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset('temp/src/plugins/src/notification/snackbar/snackbar.min.js')}}"></script>
    <script src="{{asset('temp/src/assets/js/components/notification/custom-snackbar.js')}}"></script>
    <script src="{{asset('temp/src/assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset('temp/src/plugins/src/sweetalerts2/sweetalerts2.min.js')}}"></script>
    <script src="{{asset('temp/src/plugins/src/sweetalerts2/custom-sweetalert.js')}}"></script>

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
</body>
</html>
