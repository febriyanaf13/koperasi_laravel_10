@extends('layout.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tambah User</h1>

        <div class="card mb-4 py-3 border-left-primary">
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data"
                      class="needs-validation" novalidate>
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}"
                                   required>
                            <div class="invalid-feedback">
                                Please provide a valid name.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="role">Role</label>
                            <select class="custom-select" name="role" id="role" required>
                                <option value="">Choose...</option>
                                @if(count($roles) >=1)
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}">{{$role->name}}</option>
                                    @endforeach
                                @endif

                            </select>
                            <div class="invalid-feedback">
                                Please select a valid role.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control" name="nik" id="nik" value="" required>
                            <div class="invalid-feedback">
                                Please provide a valid nik.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="" required>
                            <div class="invalid-feedback">
                                Please provide a valid email.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id="alamat" value="" required>
                            <div class="invalid-feedback">
                                Please provide a valid alamat.
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" value="" required>
                            <div class="invalid-feedback">
                                Please provide a valid password.
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit">Simpan</button>
                </form>

                <script>
                    // Example starter JavaScript for disabling form submissions if there are invalid fields
                    (function () {
                        'use strict';
                        window.addEventListener('load', function () {
                            // Fetch all the forms we want to apply custom Bootstrap validation styles to
                            var forms = document.getElementsByClassName('needs-validation');
                            // Loop over them and prevent submission
                            var validation = Array.prototype.filter.call(forms, function (form) {
                                form.addEventListener('submit', function (event) {
                                    if (form.checkValidity() === false) {
                                        event.preventDefault();
                                        event.stopPropagation();
                                    }
                                    form.classList.add('was-validated');
                                }, false);
                            });
                        }, false);
                    })();
                </script>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
