<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator as FacadesValidator;


class UserController extends Controller

{
    public function __construct()
    {
        $this->middleware('can:read role');
        //tidak bisa masuk ke create
    }
    public function index(Request $request){
        $users = user::all();
        return view('manajemen_user.index',compact('users'));


    }

    public function create()
    {
        return view('manajemen_user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
        ]);
        $role= Role::where('name','user')->first();

        $user->assignRole($role);

        event(new Registered($user));

        return redirect()->route('manajemen_user.index')->with('success','Data user berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = user::find($id);
        return view('manajemen_user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = user::find($id);
        if(!$user){
            return response()->json(['massage'=>'Data tidak ditemukan'], 404);
        }

        $validator = FacadesValidator::make($request->all(), [
            'name' => 'required',
            'email' => 'required', // Memeriksa unik kecuali untuk data dengan ID yang sedang diubah
        ]);

        //pop up validator fail belum muncul
        if ($validator->fails()) {
            return redirect()->route('manajemen_user.index', $id) // Redirect ke halaman edit dengan pesan error
                ->withErrors($validator)
                ->withInput();
        }

        $user->update($request->all());
        return redirect()->route('manajemen_user.index')->with('success', 'Data obat berhasil diupdate.');//pop upnya belum tampil

    }

    public function destroy($id)
    {
        $user = user::findOrFail($id);
        $user->delete();

        return redirect()->route('manajemen_user.index');
    }
}
