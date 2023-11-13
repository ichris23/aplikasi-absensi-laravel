<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--  Bootstrap   -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <title>Login</title>
</head>

<body>
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="col-md-5 bg-primary-subtle border border-primary-subtle rounded-6">
            <main class="form-signin w-75 m-auto">
                @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    {{ session('loginError') }}
                </div>
                @endif
                <div style="max-height: 500px; overflow:hidden">
                    <img src="/assets/img/logo_pt.jpeg" class="card-img-top img-fluid mb-2 mt-3" style="width: 100%; max-height: 400px">
                </div>
                <h1 class="h3 mb-3 fw-large text-center fs-1">Please Login</h1>
                <form action="/proseslogin" method="post">
                    @csrf
                    <div class="form-floating">
                        <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" id="nik" placeholder="name@example.com" autofocus required value="{{ old('nik') }}" autocomplete="off">
                        <label for="nik">Nomor Induk Karyawan</label>
                        @error('nik')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control " id="password" placeholder="Password">
                        <label for="password">Password</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" onclick="showPassword()">
                        <label class="form-check-label" for="flexCheckDefault">
                            Show Password
                        </label>
                    </div>
                    <script>
                        function showPassword() {
                            let passwordVal = document.getElementById("password")
                            let value = passwordVal.value

                            if (passwordVal.type === "password") {
                                passwordVal.type = "text";
                            } else {
                                passwordVal.type = "password";
                            }
                        }
                    </script>
                    <button class="btn btn-success w-100 py-2 mt-3 mb-3" type="submit">Login</button>
                </form>
            </main>
        </div>
    </div>

    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
    <script src="{{ asset('assets/js/lib/jquery-3.4.1.min.js') }}"></script>
    <!-- Bootstrap-->
    <script src="{{ asset('assets/js/lib/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/bootstrap.min.js') }}"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
    <!-- Owl Carousel -->
    <script src="{{ asset('assets/js/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    <!-- jQuery Circle Progress -->
    <script src="{{ asset('assets/js/plugins/jquery-circle-progress/circle-progress.min.js') }}"></script>
    <!-- Base Js File -->
    <script src="{{ asset('assets/js/base.js') }}"></script>

</body>

</html>