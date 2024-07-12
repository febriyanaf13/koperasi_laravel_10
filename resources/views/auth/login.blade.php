<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Koperasi - Login</title>

    @include('layout.link')

</head>

<body class="bg-gradient-primary vh-100">

<div class="container h-100">

    <!-- Outer Row -->
    <div class="row justify-content-center h-100 d-flex align-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-flex align-items-center justify-content-center">
                            <div class="p-5 centered-container">
                                <div class="container">
                                    <img src="{{ asset('images/grobogan.png') }}" alt="Deskripsi Gambar"
                                         class="h-100 w-100 ">
                                </div>
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4 my-2">Koperasi PKK Desa Lebak</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <form class="user" method="POST" action="{{route('login')}}">
                                    @csrf
                                    @if (Session::has('success'))
                                        <div class="alert alert-success">
                                            {{Session::get('success')}}
                                        </div>
                                    @endif
                                    @if (Session::has('fail'))
                                        <div class="alert alert-danger">
                                            {{Session::get('fail')}}
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user"
                                               id=email" aria-describedby="emailHelp"
                                               placeholder="Enter Email Address..." name="email">
                                        <span class="text-danger">
                                            @error('email')
                                            '{{$message}}
                                            @enderror
                                        </span>

                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                               id="password" placeholder="Password" name="password">
                                        <span class="text-danger">
                                                                    @error('password')
                                            {{$message}}
                                            @enderror
                                                                                        </span>

                                    </div>

                                    <button class="btn btn-primary btn-user btn-block" type="submit">
                                        Login
                                    </button>

                                </form>
                                <hr>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

@include('layout.script')

</body>

</html>
