<?php

namespace App\Http\Controllers\SM;

use App\Http\Controllers\Controller;
use App\Pinjam;
use App\Kategori;
use App\Barang;
use App\User;
use App\Role;
use App\Projek_karyawan;
use App\Projek;
use App\Karyawan;
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
        $projek = Projek_Karyawan::where('id_karyawan', auth()->user()->id)->get();
        $get_id_project = [];
        foreach ($projek as $value) {
            $get_id_project[] = $value->id_projek;
        }
        $test = Projek_Karyawan::whereIn('id_projek', $get_id_project)->get();
        $get_id_karyawan = [];
        foreach ($test as $value) {
            if (!in_array($value->id_karyawan, $get_id_karyawan)) {
                $get_id_karyawan[] = $value->id_karyawan;
            }
        }
        $user = User::whereIn('id', $get_id_karyawan)->get();
        $pinjam = Pinjam::whereIn('id', $get_id_karyawan)->get();
        return view('sm.Admin_invetaris.index', compact('pinjam'));
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
        // dd($request->id_barang);

        Pinjam::create([
            'id_barang' => $request->id_barang,
            'id_kategori' => $request->id_kategori,
            'id' => auth()->user()->id,
            'type' => $request->type,
            'stok' => $request->stok,
            'jumlah_pinjam' => 1,
            'tgl_pinjam' => date("Y-m-d"),
            'status' => 'Pending',
            'keterangan' => 'Saya meminjam ini untuk memudahkan dalam bekerja'
        ]);
        return redirect('/sm/invetaris')->with('status', 'Data Berhasil Di Tambah!!!');
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
        return redirect('/sm/pinjam')->with('status', 'Success');
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
}
