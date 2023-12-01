<?php

namespace App\Http\Controllers;

use App\Models\obat;
use App\Models\transaksi;
use App\Models\transaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;


class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('manajemen_transaksi.index');
    }

    public function data()
    {
        $transaksi = transaksi::orderBy('id', 'desc')->get();

        return datatables()
        ->of($transaksi)
        ->addIndexColumn()
        ->addColumn('total_item', function ($transaksi){
            return format_uang($transaksi->total_item);
        })
        ->addColumn('total_harga', function($transaksi){
            return 'Rp.'. format_uang($transaksi->total_harga);
        })
        ->addColumn('bayar', function($transaksi){
            return 'Rp,'. format_uang($transaksi->bayar);
        })
        ->addColumn('tanggal', function($transaksi){
            return tanggal_indonesia($transaksi->created_at, false);
        })
        ->editColumn('kasir', function($transaksi){
            return $transaksi->user->name ?? '';
        })
        ->editColumn('aksi', function($transaksi){
            return '
            <div class="btn-group">
                    <button onclick="showDetail(`'. route('transaksi.show', $transaksi->id) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i></button>
                    <button onclick="deleteData(`'. route('transaksi.destroy', $transaksi->id) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
        })

        ->rawColumns(['aksi'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $transaksi =  new transaksi();
        $transaksi->total_item = 0;
        $transaksi->total_harga = 0;
        $transaksi->bayar = 0;
        $transaksi->diterima = 0;
        $transaksi->user_id = auth()->id();
        $transaksi->save();

        session(['transaksi_id' => $transaksi->id]);
        return redirect()->route('transaksi.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // $variable = $request->diterima;
        // var_dump($variable);
        $penjualan = transaksi::findOrFail($request->transaksi_id);
        $penjualan->total_harga = intval($request->total);
        $penjualan->total_item = intval($request->total_item);
        $penjualan->bayar = intval($request->total);
        $penjualan->diterima = intval($request->diterima);
        $penjualan->user_id = auth()->user()->id;
        $penjualan->update();
        
        $detail = transaksiDetail::where('transaksi_id', $penjualan->id)->get();
        foreach ($detail as $item) {
            $produk = obat::find($item->obat_id);
            $produk->stok -= $item->jumlah;
            $produk->update();
        }

        return redirect()->route('transaksi.selesai');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $detail = transaksiDetail::with('obat')->where('transaksi_id', $id)->get();

        return datatables()
        ->of($detail)
        ->addIndexColumn()
        ->addColumn('obat_id', function($detail){
            return '<span class="label label-success">'. $detail->obat->id. '</span>';
        })
        ->addColumn('nama_obat', function($detail){
            return $detail->obat->nama_obat;
        })
        ->addColumn('harga_jual', function($detail){
            return 'Rp.'.format_uang($detail->harga_jual);
        })
        ->addColumn('jumlah', function($detail){
            return format_uang($detail->jumlah);
        })
        ->addColumn('subtotal', function($detail){
            return 'Rp.'.format_uang($detail->subtotal);
        })
        ->rawColumns(['obat_id'])
        ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transaksi = transaksi::find($id);
        $detail = transaksiDetail::where('transaksi_id', $transaksi->id)->get();
        foreach ($detail as $item){
            $obat = obat::find($item->id);
            if($obat){
                $obat->stok += $item->jumlah;
                $obat->update();
            }

            $item->delete();
        }
    }

    public function selesai()
    {

        return view('manajemen_transaksi.selesai');
    }

    public function notaKecil()
    {
        $penjualan = transaksi::find(session('transaksi_id'));
        if (! $penjualan) {
            abort(404);
        }
        $detail = transaksiDetail::with('obat')
            ->where('transaksi_id', session('transaksi_id'))
            ->get();
        // dd($detail);
            return view('manajemen_transaksi.nota_kecil', compact( 'penjualan', 'detail'));
        }
    }
    // $pdf = PDF::loadView('manajemen_transaksi.nota_kecil', compact('penjualan', 'detail'));
    // $pdf->setPaper(0,0,609,440, 'potrait');
