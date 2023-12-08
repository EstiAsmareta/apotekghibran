<?php

namespace App\Http\Controllers;

use App\Models\rak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RakController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('can:read role');
    //     //tidak bisa masuk ke create
    // }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $raks = rak::all();
        return view('manajemen_rak.index', compact('raks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manajemen_rak.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'rak' => 'required|string|unique:raks,rak,NULL,id,no_rak,' . $request->input('no_rak'),
        'no_rak' => 'required|numeric|unique:raks,no_rak,NULL,id,rak,' . $request->input('rak'),
    ]);

    if ($validator->fails()) {
        // Redirect back to the form with validation errors and old input
        return redirect()->route('rak.create')
            ->withErrors($validator)
            ->withInput();
    }

    $validatedData = $validator->validated();

    $rak = new Rak;
    $rak->rak = $validatedData['rak'];
    $rak->no_rak = $validatedData['no_rak'];

    $rak->save();

    return redirect()->route('rak.index')->with('success', 'Data berhasil ditambahkan');
}

    /**
     * Display the specified resource.
     */
    public function show(rak $rak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rak = rak::find($id);
        return view('manajemen_rak.edit', compact('rak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rak = rak::find($id);
        if(!$rak){
            return redirect()->route('manajemen_rak.index')->with('error', 'Data tidak ditemukan.');

        }

        $validator = Validator::make($request->all(), [
            'rak' => 'required',
            'no_rak' => 'numeric|unique:raks,no_rak,' . $id, // Memeriksa unik kecuali untuk data dengan ID yang sedang diubah
        ]);

        //pop up validator fail belum muncul
        if ($validator->fails()) {
            return redirect()->route('rak.index', $id) // Redirect ke halaman edit dengan pesan error
                ->withErrors($validator)
                ->withInput();
        }
        else{
            $rak->update($request->all());
            return redirect()->route('rak.index')->with('success', 'Data obat berhasil diupdate.');//pop upnya belum tampil
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $rak = rak::findOrFail($id);
        $rak->delete();

        return redirect()->route('rak.index')->with('success', 'Data obat berhasil dihapus.');
    }
}
