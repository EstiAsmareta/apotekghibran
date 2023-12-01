@extends('layout')
@section('content')
                    @if($errors->any())
                    @foreach($errors->all() as $error)
                        <script>
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                            });
                            Toast.fire({
                                icon: "error",
                                title: "{{ $error }}"
                            });
                        </script>
                    @endforeach
                    @endif


                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Tambah Data</h1>

                    <div class="card shadow mb-4">
                        {{-- <div class="card-header py-3">
                          <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                          <div class="m-0 card-header py-3 text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </div> --}}


                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Data Obat</h6>

                        </div>

                        <div class="container-fluid">
                            <!-- Page Heading -->
                            <form method="POST" action="{{ route('obat.store') }}">
                                @csrf

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <h6 class="m-0 font-weight-bold text-body" style="padding-top: 10px">ID Obat :</h6>
                                        <input type="text" class="form-control" name="id" placeholder="ID Obat">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <h6 class="m-0 font-weight-bold text-body" style="padding-top: 10px">Nama Obat :</h6>
                                        <input type="text" class="form-control" name="nama_obat" placeholder="Nama Obat">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <h6 class="m-0 font-weight-bold text-body">Nama Produsen :</h6>
                                        <input type="text" class="form-control" name="nama_produsen" placeholder="Nama Produsen">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <h6 class="m-0 font-weight-bold text-body">Stok :</h6>
                                        <input type="number" class="form-control" name="stok" placeholder="Stok">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <h6 class="m-0 font-weight-bold text-body">Tanggak Kadaluarsa :</h6>
                                        <input type="date" class="form-control" name="tgl_kadaluarsa" placeholder="Tanggal Kadaluarsa">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <h6 class="m-0 font-weight-bold text-body">Dosis :</h6>
                                        <input type="text" class="form-control" name="dosis" placeholder="Dosis">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <h6 class="m-0 font-weight-bold text-body">Harga Beli :</h6>
                                        <input type="number" class="form-control" name="harga_beli" placeholder="Harga Beli">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <h6 class="m-0 font-weight-bold text-body">Harga Jual :</h6>
                                        <input type="number" class="form-control" name="harga_jual" placeholder="Harga Jual">
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <h6 class="m-0 font-weight-bold text-body">Pilih Rak :</h6>
                                        <select name="rak_id" class="form-control" id="rak_id">
                                            @foreach($rakTersedia as $rak)
                                                <option value="{{ $rak->id }}">{{ $rak->rak }}-{{ $rak->no_rak }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>



                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>

                        <div class="card-body">
                          <div class="table-responsive">
                    <!-- Modal -->
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="modal-content-placeholder">
                                        <!-- Konten dari tampilan "edit" akan dimuat di sini -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                

                </div>
                <!-- /.container-fluid -->
@endsection