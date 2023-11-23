<?php

namespace App\Http\Controllers;

use App\Models\obat;
use App\Models\transaksi;
use App\Models\transaksiDetail;
use Illuminate\Http\Request;

class TransaksiDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obat = obat::orderBy('nama_obat')->get();

        if($transaksi_id = session('transaksi_id')){
            $transaksi = transaksi::find($transaksi_id);
            return view('transaksi_detail.index', compact('obat','transaksi_id','transaksi'));
        }
        // else{
        //     if(auth()->user()->level == 1){
        //         return redirect()->route('transaksi.baru');
        //     }else{
        //         return redirect()->route('dashboard');
        //     }
        // }
    }

    public function data($id)
    {
        $detail = transaksiDetail::with('obat')
        ->where('transaksi_id', $id)
        ->get();

        $data = array();
        $total = 0;
        $total_item = 0;

        foreach ($detail as $item){
            $row = array();
            $row['obat_id']     = '<span class="label label-success">'. $item->obat->id .'</span>';
            $row['nama_obat']   = $item->obat->nama_obat;
            $row['harga_jual']  = 'Rp. '. format_uang($item->harga_jual);
            $row['jumlah']      = '<input type="number" class="form-control input-sm quantity" data-id="'. $item->id .'" value="'. $item->jumlah .'">';
            $row['subtotal']    = 'Rp. '. format_uang($item->subtotal);
            $row['aksi']        = '<div class="btn-group">
                                    <button onclick="deleteData(`'. route('transaksi.destroy', $item->id) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                                </div>';
            $data[] = $row;

            $total += $item->harga_jual * $item->jumlah;
            $total_item += $item->jumlah;
        }

        $data[] = [
            'obat_id'     => '
                <div class="total hide">'. $total .'</div>
                <div class="total_item hide">'. $total_item .'</div>',
            'nama_obat'   => '',
            'harga_jual'  => '',
            'jumlah'      => '',
            'subtotal'    => '',
            'aksi'        => '',
        ];

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->rawColumns(['aksi', 'obat_id', 'jumlah'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $obat = obat::where('id',$request->obat_id)->first();
        if (! $obat){
            return response()->json('Data Gagal Disimpan', 404);
        }

        $detail = new transaksiDetail();
        $detail->transaksi_id = $request->transaksi_id;
        $detail->obat_id = $obat->id;
        $detail->harga_jual = $obat->harga_jual;
        $detail->jumlah = 1;
        $detail->subtotal = $obat->harga_jual;
        $detail->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(transaksiDetail $transaksiDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(transaksiDetail $transaksiDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $detail = transaksiDetail::find($id);
        $detail->jumlah = $request->jumlah;
        $detail->subtotal = $detail->harga_jual * $request->jumlah;
        $detail->update();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $detail = transaksiDetail::find($id);
        $detail->delete();

        return response(null, 204);
    }

    public function loadForm($total, $diterima)
    {
        $kembali = ($diterima != 0) ? $diterima - $total : 0;
        $data    = [
            'totalrp' => format_uang($total),
            'terbilang' => ucwords(terbilang($total). ' Rupiah'),
            'kembalirp' => format_uang($kembali),
            'kembali_terbilang' => ucwords(terbilang($kembali). ' Rupiah'),
        ];

        return response()->json($data);
    }
}
