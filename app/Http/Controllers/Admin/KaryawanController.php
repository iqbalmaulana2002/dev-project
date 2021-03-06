<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Projek_Karyawan;
use App\Stream;
use App\Role;
use App\Pendidikan;
use App\Projek;
use File;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('admin/karyawan/index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin/karyawan/detailkaryawan', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $stream = Stream::all();
        $pendidikan = Pendidikan::all();
        $agama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
        return view('admin/karyawan/ubahkaryawan', ['user' => $user, 'stream' => $stream, 'pendidikan' => $pendidikan, 'agama' => $agama]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nip' => 'required|numeric',
            'nama' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'email' => 'required|email',
            'jenkel' => 'required',
            'id_stream' => 'required',
            'id_pendidikan' => 'required',
            'thn_join' => 'required',
            'no_telp' => 'required|numeric',
            'agama' => 'required',
            'alamat' => 'required'
        ]);

        User::where('id', $user->id)->Update([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'email' => $request->email,
            'jenkel' => $request->jenkel,
            'id_stream' => $request->id_stream,
            'id_pendidikan' => $request->id_pendidikan,
            'thn_join' => $request->thn_join,
            'no_telp' => $request->no_telp,
            'agama' => $request->agama,
            'alamat' => $request->alamat
        ]);

        if($request->hasFile('picture')){
            $request->file('picture')->move('img/profile', $request->file('picture')->getClientOriginalName());
            $user->foto = $request->file('picture')->getClientOriginalName();
            $user->save();
        }

        return redirect('/admin/karyawan')->with('status', 'Data Karyawan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $gambar = User::where('id', $user->id)->first()->foto;
        
        if($gambar !== 'default.jpg') {
            File::delete('img/profile/' . $gambar);
            User::destroy($user->id);  
        }
        User::destroy($user->id);
        return redirect('/admin/karyawan')->with('status', 'Karyawan berhasil dihapus');
    }
    public function aktivasi(Request $request, User $user)
    {
        $is_active = User::where('id', $user->id)->first()->is_active;
        if($is_active == 1) {
            return redirect('/admin/karyawan')->with('danger', 'Akun ini sudah diaktivasi');
        }
        User::where('id', $user->id)->Update([
            'is_active' => $request->aktivasi
        ]);
        
        $admin = Role::where('role', 'Admin')->first();
        $emailAdmin = User::where('id_role', $admin->id)->first()->email;
        $emailUser = $user->email;

        $data = [
           'emailAdmin' => $emailAdmin,
           'emailUser' => $emailUser 
        ];
        Mail::send('admin/karyawan/email', $data, function ($message) use($emailUser){
            $message->from('naufalnurhidayat510@gmail.com', 'Aplikasi Telkom');
            $message->to($emailUser);
            $message->subject('Aktivasi akun oleh Admin');
        });

        return redirect('/admin/karyawan')->with('status', 'Akun karyawan berhasil diaktivasi');
    }
}
