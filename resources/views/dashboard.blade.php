@extends('layout')
@section('content')
                <div class="container-fluid">

                    <!-- Page Heading -->
                    {{-- <h6 class="mb-4 text-gray-800">{{strtoupper( auth()->user()->name) }}</h6> --}}
                    @if(auth()->user()->name == 'admin')
                    <div class="row">
                        {{-- Banyak Obat --}}
                        <div class="col-lg-6 col-xl-3 mb-4">
                            <div class="card bg-warning text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-3">
                                            <div class="text-white-75 small">Data Obat (satuan)</div>
                                            <div class="text-lg fw-bold">{{ $obat }}</div>
                                        </div>
                                        <i class="feather-xl text-white-50" data-feather="dollar-sign"></i>
                                    </div>
                                </div>
                                <div class="card-footer bg-warning d-flex align-items-center justify-content-between small">
                                    <a class="text-white stretched-link" href="{{ route('obat.index') }}">View Report</a>
                                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        {{-- banyak transaksi hari ini --}}
                        <div class="col-lg-6 col-xl-3 mb-4">
                            <div class="card bg-primary text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-3">
                                            <div class="text-white-75 small">Transaksi Hari Ini</div>
                                            <div class="text-lg fw-bold">{{ $transaksi }}</div>
                                        </div>
                                        <i class="feather-xl text-white-50" data-feather="calendar"></i>
                                    </div>
                                </div>
                                <div class="card-footer bg-primary d-flex align-items-center justify-content-between small">
                                    <a class="text-white stretched-link" href="{{ route('laporan.index') }}">View Report</a>
                                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        {{-- obat kadaluarsa --}}
                        <div class="col-lg-6 col-xl-3 mb-4">
                            <div class="card bg-primary text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-3">
                                            <div class="text-white-75 small">Obat kadaluarsa</div>
                                            <div class="text-lg fw-bold">{{ $obatexp }}</div>
                                        </div>
                                        <i class="feather-xl text-white-50" data-feather="calendar"></i>
                                    </div>
                                </div>
                                <div class="card-footer bg-primary d-flex align-items-center justify-content-between small">
                                    <a class="text-white stretched-link" href="{{ route('obat.index') }}">View Report</a>
                                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-lg-6 col-xl-3 mb-4">
                            <div class="card bg-warning text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-3">
                                            <div class="text-white-75 small">Transaksi Hari Ini</div>
                                            <div class="text-lg fw-bold">{{ $transaksi }}</div>
                                        </div>
                                        <i class="feather-xl text-white-50" data-feather="dollar-sign"></i>
                                    </div>
                                </div>
                                <div class="card-footer bg-warning d-flex align-items-center justify-content-between small">
                                    <a class="text-white stretched-link" href="{{ route('transaksi.baru') }}">transaksi</a>
                                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-3 mb-4">
                            <div class="card bg-primary text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-3">
                                            <div class="text-white-75 small">Pendapatan Hari Ini</div>
                                            <div class="text-lg fw-bold">{{ $pendapatan }}</div>
                                        </div>
                                        <i class="feather-xl text-white-50" data-feather="calendar"></i>
                                    </div>
                                </div>
                                {{-- <div class="card-footer bg-primary d-flex align-items-center justify-content-between small">
                                    <a class="text-white stretched-link" href="{{ route('laporan.index') }}">View Report</a>
                                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    @endif







                </div>
                <!-- /.container-fluid -->
@endsection
