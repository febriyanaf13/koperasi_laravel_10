@extends('layout.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Edit User</h1>

        <div class="card mb-4 py-3 border-left-primary">
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data"
                      class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name"
                                   value="{{ old('name', $user->name) }}"
                                   required>
                            <div class="invalid-feedback">
                                Please provide a valid name.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="role">Role</label>
                            <select class="custom-select" name="role" id="role" required>
                                <option value="">Choose...</option>
                                @if(count($roles) >= 1)
                                    @foreach($roles as $role)
                                        <option
                                            value="{{ $role->name }}" {{ $role->name == $user->role ? 'selected' : '' }}>{{$role->name}}</option>
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
                            <input type="text" class="form-control" name="nik" id="nik"
                                   value="{{ old('nik', $user->nik) }}" required>
                            <div class="invalid-feedback">
                                Please provide a valid NIK.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email"
                                   value="{{ old('email', $user->email) }}" required>
                            <div class="invalid-feedback">
                                Please provide a valid email.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id="alamat"
                                   value="{{ old('alamat', $user->alamat) }}" required>
                            <div class="invalid-feedback">
                                Please provide a valid alamat.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password">Password (leave blank if not changing)</label>
                            <input type="password" class="form-control" name="password" id="password">
                            <div class="invalid-feedback">
                                Please provide a valid password.
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit">Update</button>
                </form>

                <script>
                    (function () {
                        'use strict';
                        window.addEventListener('load', function () {
                            var forms = document.getElementsByClassName('needs-validation');
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
