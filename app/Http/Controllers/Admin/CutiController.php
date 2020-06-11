<?php

namespace App\Http\Controllers\Admin;

use App\Cuti;
use App\JenisCuti;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuti = Cuti::orderBy('tgl_cuti', 'desc')->get();
        return view('admin/cuti/index', ['cuti' => $cuti]);
    }

    public function cutiAdmin()
    {
        $cuti = Cuti::where('id_karyawan', auth()->user()->id)->orderBy('tgl_cuti', 'desc')->get();
        return view('admin/cuti/show', ['cuti' => $cuti]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */

    public function filterData(Request $request)
    {
        $cuti;
        if (empty($request->status) && empty($request->awal) && empty($request->akhir)) {
            $cuti = Cuti::orderBy('tgl_cuti', 'desc')->get();
        } elseif (empty($request->awal) || empty($request->akhir)) {
            $cuti = Cuti::where('status', $request->status)->orderBy('tgl_cuti', 'desc')->get();
        } elseif (empty($request->status)) {
            $cuti = Cuti::whereDate('tgl_cuti', '>=', $request->awal)->whereDate('tgl_cuti', '<=', $request->akhir)->orderBy('tgl_cuti', 'desc')->get();
        } else {
            $cuti = Cuti::whereDate('tgl_cuti', '>=', $request->awal)
                        ->whereDate('tgl_cuti', '<=', $request->akhir)
                        ->where('status', $request->status)
                        ->orderBy('tgl_cuti', 'desc')
                        ->get();
        }
        return view('admin/cuti/filter', compact('cuti'));
    }
    
    public function detailCuti(Cuti $cuti)
    {
        return view('admin/cuti/detailCuti', compact('cuti'));
    }

    /**
     * Show the form for updating the specified resource.
     *
     * @param  \App\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */

    public function updateJatahCuti()
    {
        User::whereIn('is_active', [0, 1])->Update(['jatah_cuti' => 12]);
        return redirect('/admin/cuti')->with('status', 'Semua Jatah Cuti Karyawan telah Direset menjadi 12');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuti $cuti)
    {
        if ($request['status'] == "Ditolak") {
            Cuti::Where('id', $cuti->id)->Update([
                'status' => $request['status'],
                'jatah_cuti_terakhir' => $cuti->user->jatah_cuti,
                'alasan_tolak_terima' => $request['alasan_tolak']
            ]);
            $pesan = 'Penolakan Pengajuan Cuti';
        } elseif ($request['status'] == "Diterima") {
            Cuti::Where('id', $cuti->id)->Update([
                'status' => $request['status'],
                'jatah_cuti_terakhir' => $cuti->user['jatah_cuti'],
                'alasan_tolak_terima' => $request['alasan_terima']
            ]);
            if ($cuti->jenis_cuti->jenis_cuti == 'Cuti Tahunan') {
                $karyawan = User::where('id', $cuti->id_karyawan)->first();
                $newJatahCuti = $karyawan->jatah_cuti - $cuti->total_cuti;
                User::Where('id', $cuti->id_karyawan)->update(['jatah_cuti' => $newJatahCuti]);
            }
            $pesan = 'Penerimaan Pengajuan Cuti';
        } else {
            return redirect('/admin/cuti')->with('gagal', 'Status Gagal Di Edit');
        }
        // $data = [
            //     'id' => $cuti->id,
            //     'nip' => $cuti->user->nip,
            //     'nama' => $cuti->user->nama,
            //     'email' => $cuti->user->email,
            //     'jenkel' => $cuti->user->jenkel,
            //     'stream' => $cuti->user->stream->stream,
            //     'no_telp' => $cuti->user->no_telp
            // ];
            // Mail::send('admin/cuti/email', $data, function ($message) use($admin){
            //     $message->from('naufalnurhidayat510@gmail.com', 'Aplikasi Telkom');
            //     $message->to($admin->email, $admin->nama);
            //     $message->subject($pesan);
            // });
        return redirect('/admin/cuti')->with('status', 'Status Berhasil Di Edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuti $cuti)
    {
        Cuti::destroy($cuti->id);
        return redirect('/admin/cuti')->with('status', 'Data Berhasil di Hapus');
    }
}
