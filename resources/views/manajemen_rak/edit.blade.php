<form method="POST" action="{{ route('rak.update', ['id' => $rak->id]) }}">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="rak">Rak</label>
        <input type="text" name="rak" id="rak" class="form-control" value="{{ $rak->rak }}">
    </div>

    <div class="form-group">
        <label for="no_rak">Nomor Rak</label>
        <input type="number" name="no_rak" id="no_rak" class="form-control" value="{{ $rak->no_rak }}">
    </div>

    <div class="modal-footer">
        <button class="btn btn-sm btn-flat btn-primary" type="submit"><i class="fa fa-save"></i> Save changes</button>
    </div>

</form>