<?php

namespace App\Http\Controllers\PO;
use App\Http\Controllers\Controller;
use App\Pinjam;
use App\Kategori;
use App\Barang;
use App\User;
use App\Role;
use App\Projek;
use App\Projek_Karyawan;
use Illuminate\Http\Request;

class pinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $projek = Projek_Karyawan::where('id', auth()->user()->id)->first();
        $data_karyawan = Projek_Karyawan::where('id_projek', $projek->id_projek)->get();
        $get_id_by_projek = Projek_Karyawan::where('id_projek', $projek->id_projek)->pluck('id_karyawan')->toArray();
        $pinjam = Pinjam::whereIn('id', $get_id_by_projek)->get();
        return view('po.Admin_invetaris.index', compact(['pinjam', 'data_karyawan', 'projek']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_barang)
    {
        // $barang = Barang::where('id_barang', $id_barang)->first();
        // $kategori = Kategori::where('id_kategori', $barang->id_kategori)->first();
        // return view('Invetaris.formInvetaris', ['barang' => $barang, 'kategori' => $kategori]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        Pinjam::create([
            'id_barang' => $request->id_barang,
            'id_kategori' => $request->id_kategori,
            'id' => auth()->user()->id,
            'type' => $request->type,
            'stok' => $request->stok,
            'jumlah_pinjam' => 1,
            'tgl_pinjam' => date("Y-m-d"),
            'status' => 'Pending',
            'keterangan' => 'Saya meminjam barang ini untuk memudahkan saya dalam bekerja'
        ]);
        return redirect('/po/invetaris')->with('status', 'Data Berhasil Di Tambah!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function show(pinjam $id)
    {
        $pinjam = Pinjam::where('id', $id->id)->get();
        return view('admin.Admin_invetaris.show', compact('pinjam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function edit($id_pinjam)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pinjam)
    {
        Pinjam::where('id_pinjam', $pinjam)->Update(['status' => $request['status']]);
        if($request['status'] == "Accept"){
            $p = Pinjam::where('id_pinjam', $pinjam)->first();
            $barang = Barang::where('id_barang', $p->id_barang)->first();
            // return $barang->stok-1;
            $k = $barang->stok-1;
            Barang::where('id_barang', $barang->id_barang)->update(['stok' => $k]);
        }
        return redirect('/po/pinjam')->with('status', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pinjam $pinjam)
    {
        //
    }

    public function periode(Request $request)
    {
        $pinjam = Pinjam::where('tgl_pinjam', '>=', $request->Awal)->where('tgl_pinjam', '<=', $request->Akhir)->orderBy('tgl_pinjam', 'desc')->get();
        return view('po/Admin_invetaris/filter', compact('pinjam'));
    }
}
