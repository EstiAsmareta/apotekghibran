<div class="modal fade" id="modal-produk" tabindex="-1" role="dialog" aria-labelledby="modal-produk">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pilih Obat</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-produk">
                    <thead>
                        <th width="5%">No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Harga Beli</th>
                        <th>Rak</th>
                        <th><i class="fa fa-cog"></i></th>
                    </thead>
                    <tbody>
                        @foreach ($obat as $key => $item)
                            <tr>
                                <td width="5%">{{ $key+1 }}</td>
                                <td><span class="label label-success">{{ $item->id }}</span></td>
                                <td>{{ $item->nama_obat }}</td>
                                <td>{{ $item->harga_jual }}</td>
                                <td>{{ $item->rak->rak }} {{ $item->rak->no_rak }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-xs btn-flat"
                                        onclick="pilihObat('{{ $item->id }}', '{{ $item->nama_obat }}')">
                                        <i class="fa fa-check-circle"></i>
                                        Pilih
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>