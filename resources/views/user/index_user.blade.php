@extends('layout.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Pengguna</h1>

        @if (session('success'))
            <div class="col-lg-12 mb-4">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                        Success
                        <div class="text-white-50 small">{{ session('success') }}</div>
                    </div>
                </div>
            </div>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{route('users.create')}}" class="btn btn-info btn-icon-split col-auto">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus-square"></i>
                                        </span>
                    <span class="text">Tambah Data</span>
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Name</th>
                            <th>NIK</th>
                            <th>Alamat</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Status</th>
                            @if(Auth::user()->role === 'admin')
                                <th class="text-center">Aksi</th>
                            @endif
                        </tr>
                        </thead>

                        <tbody>
                        @php $no = 0; @endphp
                        @foreach($users as $user)
                            <tr>
                                <td class="text-center">{{ ++$no }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{$user->nik}}</td>
                                <td>{{$user->alamat}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role}}</td>
                                <td>{{$user->status}}</td>
                                @if(Auth::user()->role === 'admin')

                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                              action="{{ route('users.destroy', $user->id) }}" method="POST">

                                            <a href="{{route('users.edit', $user->id)}}"
                                               class="btn btn-primary btn-icon-split btn-sm my-1"
                                               data-bs-toggle="tooltip"
                                               data-bs-placement="top" title="Edit">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-pen"></i>
                                        </span>
                                                {{--                                            <span class="text">Edit</span>--}}
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-icon-split btn-sm"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Delete"><span
                                                    class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                                {{--                                            <span class="text">Delete</span>--}}
                                            </button>

                                        </form>

                                    </td>
                                @endif

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection

