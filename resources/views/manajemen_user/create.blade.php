@extends('layout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tambah Data</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
        </div>

        <div class="card-body">
            <!-- Page Heading -->
            <form method="POST" action="{{ route('user.store') }}">
                @csrf
                <!-- Tambahkan input fields sesuai dengan kebutuhan Anda -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="name" class="text-sm text-gray-600 dark:text-gray-400">Name</label>
                        <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="form-group col-md-6">
                        <label for="email" class="text-sm text-gray-600 dark:text-gray-400">Email</label>
                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="form-group col-md-6">
                        <label for="password" class="text-sm text-gray-600 dark:text-gray-400">Password</label>
                        <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group col-md-6">
                        <label for="password_confirmation" class="text-sm text-gray-600 dark:text-gray-400">Confirm Password</label>
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>
                <!-- Tambahkan field lainnya sesuai dengan model Obat Anda -->

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
