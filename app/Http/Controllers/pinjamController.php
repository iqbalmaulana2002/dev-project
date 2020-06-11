<?php

namespace App\Http\Controllers;

use App\Pinjam;
use App\Kategori;
use App\Barang;
use App\User;
use App\Role;
use File;
use Mail;
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;

class pinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        // $pinjam = Pinjam::all();
        $pinjam = Pinjam::orderBy('tgl_pinjam', 'desc')->get();
        return view('admin.Admin_invetaris.index', compact('pinjam'));
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
        // $request->validate([
        //     'keterangan' => 'required'
        // ]);

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
        return redirect('/invetaris')->with('status', 'Data Berhasil Di Tambah!!!');
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
        return redirect('/admin/pinjam')->with('status', 'Success');
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
        // return $request;
        // try {
        //     $dari = $request->dari;
        //     $sampai = $request->sampai;
        //     $pinjam = Pinjam::whereDate('tgl_pinjam', '>=',$dari)->whereDate('tgl_pinjam', '<=',$sampai)->get();
        //     return view('admin.Admin_invetaris.index', compact('pinjam'));
        // } catch (\Exception $e) {
        //     \Session::flash('gagal', $e->getMessage());
        // }
        $pinjam = Pinjam::where('tgl_pinjam', '>=', $request->Awal)->where('tgl_pinjam', '<=', $request->Akhir)->orderBy('tgl_pinjam', 'desc')->get();
        return view('admin.Admin_invetaris.filter', compact('pinjam'));
    }

    public function Email(Request $request, $id)
    {
        $admin = Role::where('role', 'Admin')->first();
        $emailAdmin = User::where('id_role', $admin->id)->first()->email;
        $emailUser = $id->email;

        $data = [
           'emailAdmin' => $emailAdmin,
           'emailUser' => $emailUser 
        ];
        Mail::send('admin/Admin_invetaris/email', $data, function ($message) use($emailUser){
            $message->from('naufalnurhidayat510@gmail.com', 'Aplikasi Telkom');
            $message->to($emailUser);
            $message->subject('Aktivasi akun oleh Admin');
        });

        return redirect('/admin/pinjam')->with('status', 'Pesan sudah terkirim');
    }
}
