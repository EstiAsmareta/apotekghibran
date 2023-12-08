@extends('layout')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Laporan Pendapatan {{ tanggal_indonesia($tanggalAwal, false) }} s/d
            {{ tanggal_indonesia($tanggalAkhir, false) }}</h1>

        <div class="card shadow mb-4">
            {{-- <div class="card-header py-3">
                          <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                          <div class="m-0 card-header py-3 text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </div> --}}


            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Laporan</h6>
                <div>
                    <button onclick="updatePeriode()" class="btn btn-info btn-xs btn-flat"><i class="fa fa-plus-circle"></i>
                        Ubah Periode</button>
                    <a href="{{ route('laporan.export_pdf', [$tanggalAwal, $tanggalAkhir]) }}" target="_blank"
                        class="btn btn-success btn-xs btn-flat"><i class="fa fa-file-excel-o"></i> Export PDF</a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div class="box-body table-responsive">
                        <table class="table table-stiped table-bordered">
                            <thead>
                                <th width="5%">No</th>
                                <th>Tanggal</th>
                                <th>Penjualan</th>
                                <th>Total Obat</th>
                                <th>Transaksi</th>
                                {{-- <th>Pendapatan</th> --}}
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @includeIf('laporan.form')
        @endsection

        @push('scripts')
        <script src="{{ asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
        <script>
            let table;

            $(function () {
                table = $('.table').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    ajax: {
                        url: '{{ route('laporan.data', [$tanggalAwal, $tanggalAkhir]) }}',
                    },
                    columns: [
                        {data: 'DT_RowIndex', searchable: false, sortable: false},
                        {data: 'tanggal'},
                        {data: 'penjualan'},
                        {data: 'total_item'},
                        {data: 'total_transaksi'},
                        // {data: 'pendapatan'}
                    ],
                    dom: 'Brt',
                    bSort: false,
                    bPaginate: false,
                });

                $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true
                });
            });

            function updatePeriode() {
                $('#modal-form').modal('show');
            }
        </script>
        @endpush
