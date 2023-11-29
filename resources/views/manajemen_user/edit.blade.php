<form method="POST" action="{{ route('user.update', ['id' => $user->id]) }}">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="email">Nama</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
    </div>

    <div class="form-group">
        <label for="email">email</label>
        <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}">
    </div>

    <div class="modal-footer">
        <button class="btn btn-primary" type="submit">Save changes</button>
    </div>

</form>