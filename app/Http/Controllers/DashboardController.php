<?php

namespace App\Http\Controllers;

use App\Models\obat;
use App\Models\transaksi;
use App\Models\transaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obat = obat::count();
        $transaksi = TransaksiDetail::whereHas('transaksi', function ($query) {
            $query->whereDate('created_at', Carbon::today());
        })->count();
        $obatexp = obat::whereDate('tgl_kadaluarsa', Carbon::today())->count();
        $pendapatan = transaksi::whereDate('created_at', Carbon::today())->sum('bayar');


        return view('dashboard', compact('obat','transaksi', 'obatexp', 'pendapatan'));

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
