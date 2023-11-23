@extends('layout')
@section('content')
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Manajemen User</h1>

                    <div class="card shadow mb-4">
                        {{-- <div class="card-header py-3">
                          <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                          <div class="m-0 card-header py-3 text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </div> --}}


                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
                            <div>
                                <button type="tambah" class="btn btn-primary">Tambah</button>
                            </div>
                        </div>

                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email User</th>
                                <th>Terdaftar sejak</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        <a href="" class="btn btn-primary">Edit</a>
                                        <a href="" class="btn btn-danger">Hapus</a>
                                    </td>
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
