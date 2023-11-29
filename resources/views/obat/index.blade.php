{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

@extends('layout')
@section('content')
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Manajemen Obat</h1>

                    <div class="card shadow mb-4">
                        {{-- <div class="card-header py-3">
                          <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                          <div class="m-0 card-header py-3 text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </div> --}}


                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Data Obat</h6>
                            <div>
                                <a type="tambah" class="btn btn-primary" href="{{route('obat.create')}}" >Tambah</a>
                            </div>
                        </div>

                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Obat</th>
                                    <th>ID Obat</th>
                                    <th>Brand</th>
                                    <th>Stok</th>
                                    <th>Tanggal Kadaluarsa</th>
                                    <th>Dosis</th>
                                    <th>Rak</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Admin</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($obats as $index => $obat)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $obat->nama_obat }}</td>
                                    <td>{{ $obat->id }}</td>
                                    <td>{{ $obat->nama_produsen }}</td>
                                    <td>{{ $obat->stok }}</td>
                                    <td>{{ $obat->tgl_kadaluarsa }}</td>
                                    <td>{{ $obat->dosis }}</td>
                                    <td>{{ $obat->rak->rak }} {{ $obat->rak->no_rak }}</td>
                                    <td>{{ $obat->harga_beli }}</td>
                                    <td>{{ $obat->harga_jual }}</td>
                                    <td>{{ $obat->user->name}}</td>
                                    <td class="d-flex align-items-center">
                                        <!-- Edit Button -->
                                        <button class="btn btn-primary edit-button me-2" type="button" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalScrollable" style="margin-top: -13px;" data-id="{{ $obat->id }}">Edit</button>

                                        <!-- Delete Button (you can use a form for a better approach) -->
                                        <form action="{{ route('obat.destroy', ['id' => $obat->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" style="margin-left: 5px; margin-top: 10px;">Delete</button>
                                        </form>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    <!-- Modal -->
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Obat</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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

@push('scripts')
<script>
    $(document).ready(function() {
        $('.edit-button').click(function() {
            var obatId = $(this).data('id');
            $('#editModal').modal('show');

            // Load the "edit" view content into the modal
            $.get("{{ route('obat.edit', ':id') }}".replace(':id', obatId), function(data) {
                // Proses data yang diterima dari server
                $('#modal-content-placeholder').html(data);
            });
        });
    });

    function confirmDelete() {
        if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
            document.getElementById('delete-form').submit();
        }
    }
</script>
@endpush
