<?php

namespace App\Http\Controllers\PO;

use App\barang;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kategori;
use App\Pinjam;
use App\User;
use App\Kembali;
use App\Role;
use PDF;


class barangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::all();
        $kategori = Kategori::all();
        $kembali = Kembali::all();
        // return $kembali;
        $pinjam = Pinjam::where('id', auth()->user()->id)->get();
        // echo "<pre>"; print_r($pinjam); exit;
        return view('/po/Invetaris/barang', ['kategori' => $kategori, 'pinjam' => $pinjam, 'barang' => $barang, 'kembali' => $kembali]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        Pinjam::create([
            'id_barang' => $request->id_barang,
            'id_kategori' => $request->id_kategori,
            'id' => $request->id,
            'type' => $request->type,
            'stok' => $request->stok,
            'jumlah_pinjam' => $request->jumlah,
            'tgl_pinjam' => date("Y-m-d"),
            'keterangan' => $request->keterangan
        ]);
        return redirect('/invetaris/pengajuan')->with('status', 'Data Berhasil Di Tambah!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show($id_pinjam)
    {
        $pinjam = Pinjam::find($id_pinjam);
        return view('Invetaris.Showbarang', compact('pinjam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, barang $barang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pinjam = Pinjam::where('id_pinjam', $id)->delete();
        return redirect('/po/invetaris')->with('status', 'Data Berhasil di Hapus!!!!');
    }

    public function showpinjam()
    {
        // $data = ::findOrFail();
        // $user = Barang::table('barang')->get();
        $user = Barang::all();
        return view('Invetaris.pinjam', compact(['Barang'=> $user]));
    }

    public function tampil()
    {
        $barang = Barang::all();
        $kategori = Kategori::all();
        return view('po.Invetaris.pengajuan', ['barang' => $barang, 'kategori' => $kategori]);
    }

    public function exportPdf($id)
    {
        $pinjam = Pinjam::where('id_pinjam', $id)->get();
        $pdf = PDF::loadView('/po/Invetaris/export', ['pinjam' => $pinjam]);
        return $pdf->stream('Data Absensi');
    }

    public function filter(Request $request)
    {
        if (empty($request->kategori_id)) {
            $barang = Barang::orderBy('nama_barang', 'desc')->get();
            } else {
            $barang = Barang::where('id_kategori', $request->kategori_id)->get();
            }
            return view('/po/Invetaris/filter', compact('barang'));
    }
}
