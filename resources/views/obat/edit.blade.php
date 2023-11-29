<form method="POST" action="{{ route('obat.update', ['id' => $obat->id]) }}">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="nama_obat">Nama Obat</label>
        <input type="text" name="nama_obat" id="nama_obat" class="form-control" value="{{ $obat->nama_obat }}">
    </div>

    <div class="form-group">
        <label for="nama_produsen">Brand</label>
        <input type="text" name="nama_produsen" id="nama_produsen" class="form-control" value="{{ $obat->nama_produsen }}">
    </div>

    <div class="form-group">
        <label for="stok">Stok</label>
        <input type="number" name="stok" id="stok" class="form-control" value="{{ $obat->stok }}">
    </div>

    <div class="form-group">
        <label for="tgl_kadaluarsa">Tanggal Kadaluarsa</label>
        <input type="date" name="tgl_kadaluarsa" id="tgl_kadaluarsa" class="form-control" value="{{ $obat->tgl_kadaluarsa }}">
    </div>

    <div class="form-group">
        <label for="dosis">dosis</label>
        <input type="text" name="dosis" id="dosis" class="form-control" value="{{ $obat->dosis }}">
    </div>

    <div class="form-group">
        <label for="harga_beli">Harga Beli</label>
        <input type="number" name="harga_beli" id="harga_beli" class="form-control" value="{{ $obat->harga_beli }}">
    </div>

    <div class="form-group">
        <label for="harga_jual">Harga Jual</label>
        <input type="number" name="harga_jual" id="harga_jual" class="form-control" value="{{ $obat->harga_jual }}">
    </div>

    <div class="form-group">
        <label for="harga_jual">Rak</label>
        <select name="rak_id" class="form-control" id="rak_id">
            @foreach($rakTersedia as $rak)
                <option value="{{ $rak->id }}">{{ $rak->rak }}-{{ $rak->no_rak }}</option>
            @endforeach
        </select>
    </div>

    <div class="modal-footer">
        <button class="btn btn-primary" type="submit">Save changes</button>
    </div>
</form>
{{-- pop up belum tampil --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
