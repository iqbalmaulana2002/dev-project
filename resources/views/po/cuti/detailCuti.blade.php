@extends('templates/template-po')

@section('title', 'Detail Cuti')

@section('content')
<div class="container">
<!-- DataTales Example -->
  <div class="card shadow">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Detail Cuti {{$cuti->user['nama']}}</h5>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-3 my-auto pb-5">
          <img src="{{asset('img/profile/'.$cuti->user['foto'])}}" class="card-img-bottom rounded-pill">	
        </div>
        <div class="col-md-9 my-auto">
          <div class="table-responsive">
            <table class="table table-striped" cellspacing="0">
              <tr>
                <td>Nama Karyawan</td>
                <td>:</td>
                <td><strong>{{$cuti->User['nama']}}</strong></td>
              </tr>
              <tr>
                <td>Email</td>
                <td>:</td>
                <td><strong>{{$cuti->user->email}}</strong></td>
              </tr>
              <tr>
                <td>No. Telepon</td>
                <td>:</td>
                <td><strong>{{$cuti->user->no_telp}}</strong></td>
              </tr>
              <tr>
                <td>Stream</td>
                <td>:</td>
                <td><strong>{{$cuti->user->stream['stream']}}</strong></td>
              </tr>
              <tr>
                <td>Tanggal Cuti</td>
                <td>:</td>
                <td><strong>{{$cuti->tgl_cuti}}</strong></td>
              </tr>
              <tr>
                <td>Jenis Cuti</td>
                <td>:</td>
                <td><strong>{{$cuti->jenis_cuti['jenis_cuti']}}</strong></td>
              </tr>
              <tr>
                <td>Lama Cuti</td>
                <td>:</td>
                <td><strong>{{$cuti->awal_cuti}} - {{$cuti->akhir_cuti}}</strong></td>
              </tr>
              <tr>
                <td>Alasan Cuti</td>
                <td>:</td>
                <td><strong>{{$cuti->alasan_cuti}}</strong></td>
              </tr>
              <tr>
                <td>Status</td>
                <td>:</td>
                <td><strong><div class="badge badge-warning">{{$cuti->status}}</div></strong></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="text-center mt-3 mb-5 pb-4">
    <form action="{{url('/po/cuti/'.$cuti->id)}}" method="post">
      @csrf
      @method('patch')
      <a href="{{url('/po/cuti/')}}" class="btn btn-primary">Kembali</a>
      <button class="btn btn-danger" onclick="return confirm('Yakin ingin menolak?');" type="submit" name="status" value="Tolak"><i class="fa fa-times-circle"></i> Tolak</button>
      <button class="btn btn-success" onclick="return confirm('Yakin ingin menerima?');" type="submit" name="status" value="Terima"><i class="fa fa-check"></i> Terima</button>
    </form>
  </div>
</div>
<!-- /.container-fluid -->
@endsection