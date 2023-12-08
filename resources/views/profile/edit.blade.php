@extends('layout')

@section('content')
    <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card">
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
            </div>
    </div>
@endsection
