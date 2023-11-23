@extends('layout')
@push('css')
<style>
    .tampil-bayar {
        font-size: 5em;
        text-align: center;
        -webkit-text-fill-color: #f0f0f0;
        height: 100px;
    }

    .tampil-terbilang {
        padding: 10px;
        background: #f0f0f0;
    }

    .table-transaksi tbody tr:last-child {
        display: none;
    }

    @media(max-width: 768px) {
        .tampil-bayar {
            font-size: 3em;
            height: 70px;
            padding-top: 5px;
        }
    }
</style>
@endpush
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Transaksi</h1>

    <div class="card shadow mb-4">
        {{-- <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
          <div class="m-0 card-header py-3 text-right">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div> --}}


        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Transaksi</h6>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <div class="box-body">

                            <form class="form-produk">
                                @csrf
                                <div class="form-group row">
                                    {{-- <label for="obat_id" class="col-lg-2">Kode Obat</label> --}}
                                    <div class="col-lg-5">
                                        <div class="input-group">
                                            <input type="hidden" name="transaksi_id" id="transaksi_id" value="{{ $transaksi_id }}">
                                            <input type="hidden" name="obat_id" id="obat_id">
                                            {{-- <input type="text" class="form-control" name="nama_obat" id="nama_obat"> --}}
                                            <span class="input-group-btn">
                                                <button onclick="tampilObat()" class="btn btn-success btn-flat" type="button"><i>Cari Obat</i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <table class="table table-striped table-bordered table-transaksi">
                                <thead>
                                    <th width="5%">No</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th width="15%">Jumlah</th>
                                    <th>Subtotal</th>
                                    <th width="15%"><i class="fa fa-cog"></i></th>
                                </thead>
                            </table>

                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="tampil-bayar bg-primary"></div>
                                    <div class="tampil-terbilang"></div>
                                </div>
                                <div class="col-lg-4">
                                    <form action="{{ route('transaksi.simpan') }}" class="form-penjualan" method="post">
                                        @csrf
                                        <input type="hidden" name="transaksi_id" value="{{ $transaksi_id }}">
                                        <input type="hidden" name="total" id="total">
                                        <input type="hidden" name="total_item" id="total_item">
                                        <input type="hidden" name="totalsl" id="totalsl">

                                        <div class="form-group row">
                                            <label for="totalrp" class="col-lg-2 control-label">Total</label>
                                            <div class="col-lg-8">
                                                <input type="text" id="totalrp" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="diterima" class="col-lg-2 control-label">Diterima</label>
                                            <div class="col-lg-8">
                                                <input type="number" id="diterima" class="form-control" name="diterima" value="0">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="kembali" class="col-lg-2 control-label">Kembali</label>
                                            <div class="col-lg-8">
                                                <input type="text" id="kembali" name="kembali" class="form-control" value="0" readonly>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" style="padding: 10px" class="btn btn-primary btn-sm btn-flat pull-right btn-simpan"><i class="fa fa-floppy-o"></i> Simpan Transaksi</button>
                        </div>
                    </div>
                </div>
            </div>

            @includeIf('transaksi_detail.obat')
            @endsection

            @push('scripts')

            <script>
                let table, table2;

                $(function () {
                    $('body').addClass('sidebar-collapse');

                    table = $('.table-transaksi').DataTable({
                        processing: true,
                        autoWidth: false,
                        ajax: {
                            url: '{{ route('transaksi.data', $transaksi_id) }}',
                        },
                        columns: [
                            {data: 'DT_RowIndex', searchable: false, sortable: false},
                            {data: 'obat_id'},
                            {data: 'nama_obat'},
                            {data: 'harga_jual'},
                            {data: 'jumlah'},
                            {data: 'subtotal'},
                            {data: 'aksi', searchable: false, sortable: false},
                        ],
                        dom: 'Brt',
                        bSort: false,
                    })
                    .on('draw.dt', function () {
                        loadForm($('#diterima').val());
                        setTimeout(() => {
                            $('#diterima').trigger('input');
                        }, 300);
                    });

                     table2 = $('.table-produk').DataTable();

                    $(document).on('input', '.quantity', function () {
                        let id = $(this).data('id');
                        let jumlah = parseInt($(this).val());

                        if (jumlah < 1) {
                            $(this).val(1);
                            alert('Jumlah tidak boleh kurang dari 1');
                            return;
                        }
                        if (jumlah > 10000) {
                            $(this).val(10000);
                            alert('Jumlah tidak boleh lebih dari 10000');
                            return;
                        }

                        $.post(`{{ url('/transaksi') }}/${id}`, {
                                '_token': $('[name=csrf-token]').attr('content'),
                                '_method': 'put',
                                'jumlah': jumlah
                            })
                            .done(response => {
                                $(this).on('mouseout', function () {
                                    table.ajax.reload();
                                });
                            })
                            .fail(errors => {
                                alert('Tidak dapat menyimpan data');
                                return;
                            });
                    });

                    // $('#diterima').on('input', function () {
                    //     if ($(this).val() == "") {
                    //         $(this).val(0).select();
                    //     }
                    // }).focus(function () {
                    //     $(this).select();
                    // });

                    $('#diterima').on('input', function () {
                        var diterima = $(this).val();
                         loadForm(diterima);
                    });

                    $('.btn-simpan').on('click', function () {
                        $('.form-penjualan').submit();
                    });
                });

                function tampilObat() {
                    $('#modal-produk').modal('show');
                }

                function hideObat() {
                    $('#modal-produk').modal('hide');
                }

                function pilihObat(id, nama) {
                    $('#obat_id').val(id);
                    $('#nama_obat').val(nama);
                    hideObat();
                    tambahObat();
                }

                function tambahObat() {
                    $.post('{{ route('transaksi.store') }}', $('.form-produk').serialize())
                        .done(response => {
                            $('#obat_id').focus();
                            table.ajax.reload();
                        })
                        .fail((jqXHR, textStatus, errorThrown) => {
                        if (jqXHR.responseJSON && jqXHR.responseJSON.errors) {
                            // Jika server mengembalikan pesan kesalahan dalam format JSON
                            let errorMessages = Object.values(jqXHR.responseJSON.errors).flat().join('\n');
                            alert('Tidak dapat menyimpan data. Kesalahan:\n' + errorMessages);
                        } else {
                            // Jika tidak ada pesan kesalahan yang terstruktur, tampilkan pesan kesalahan umum
                            alert('Tidak dapat menyimpan data. Kesalahan tidak terduga.');
                        }
                        return;
                    });
                }

                function deleteData(url) {
                    if (confirm('Yakin ingin menghapus data terpilih?')) {
                        $.post(url, {
                                '_token': $('[name=csrf-token]').attr('content'),
                                '_method': 'delete'
                            })
                            .done((response) => {
                                table.ajax.reload();
                            })
                            .fail((errors) => {
                                alert('Tidak dapat menghapus data');
                                return;
                            });
                    }
                }

                function loadForm(diterima=0) {
                    $('#total').val($('.total').text());
                    // $('#total').val(parseInt($('.total').text(), 10));
                    $('#total_item').val($('.total_item').text());

                    $.get(`{{ url('/transaksi/loadform') }}/${$('.total').text()}/${diterima}`)
                    .done(response => {
                            $('#totalrp').val('Rp. '+ response.totalrp);
                            $('#totalsl').val(response.totalrp);
                            $('.tampil-bayar').text('Total: Rp. '+ response.totalrp);
                            $('.tampil-terbilang').text(response.terbilang);

                            $('#kembali').val('Rp.'+ response.kembalirp);
                            if ($('#diterima').val() != 0) {
                                $('.tampil-bayar').text('Kembali: Rp. '+ response.kembalirp);
                                $('.tampil-terbilang').text(response.kembali_terbilang);
                            }
                        })
                        .fail(errors => {
                            alert('Tidak dapat menampilkan data');
                            return;
                        })
                }
            </script>
            @endpush
        </div>
      </div>

</div>
