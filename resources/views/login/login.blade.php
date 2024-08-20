<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login | Smart Door-Lock RFID</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('css\sbadmin2\CSS\all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css\sbadmin2\CSS\sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body>
<br>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-lg-block">
                                <img src="{{ asset('/vendor/template/img/logo smartlock.png') }}" class="img-fluid">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                                    </div>
                                    @if (session()->has('loginError'))
                                        <div class="alert alert-warning" role="alert">
                                            <strong>{{ session('loginError') }}</strong> Silakan Cek Kembali Username
                                            dan Password
                                        </div>
                                    @endif
                                    @if (session()->has('successRegister'))
                                        <div class="alert alert-success" role="alert">
                                            <strong>{{ session('successRegister') }}</strong> Silakan Hubungi Role Admin atau Jabatan Manager
                                            Untuk Mengaktifkan Akunmu
                                        </div>
                                    @endif
                                    <form class="user" action="/login" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Alamat Email..." name="email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Kata sandi" name="password">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Masuk</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="/register">Buat Akun!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <br>
    <br>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('css\sbadmin2\JS\jquery.min.js') }}"></script>
    <script src="{{ asset('vendor\bootstrap\js\bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('css\sbadmin2\JS\jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('css\sbadmin2\JS\sb-admin-2.min.js') }}"></script>

</body>

</html>

@push('scripts')
    <script>
        $('.alert').alert()
    </script>
@endpush
