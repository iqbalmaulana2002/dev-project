@extends('templates/template-sm')

@section('title', 'Data Barang')

@section('content')


@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  
  <h1 class="h3 mb-2 text-gray-800">Data Barang</h1>
  <a href="{{url('/sm/tampil/table')}}" class="btn btn-primary mb-2">Pengajuan</a>
  {{-- <a href="{{url('/invetaris/keranjang')}}" class="btn btn-warning mb-2"><i class="fa fa-shopping-cart"> Keranjang</i></a> --}}
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">

    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" height="20px" cellspacing="0">
          <thead class="thead-dark">
            <tr align="center">
              {{-- <th>No</th> --}}
              <th>Nama Barang</th>
              <th>Nama Kategori</th>
              <th>Jumlah Pinjam</th>
              <th>Tanggal Pinjam</th>
              <th>Kembali</th>
              <th>Status</th>  
              <th>Action</th>
            </tr>
          </thead>
      
          <tbody>
            {{-- @php $i=1 @endphp --}}
            @foreach($pinjam as $box)
           <tr align="center">
           {{-- <td>{{$i++}}</td> --}}
           <td>{{$box->Barang['nama_barang']}}</td>
           <td>{{$box->Kategori->nama_kategori}}</td>
           <td>{{$box->jumlah_pinjam}}</td>
           <td>{{$box->tgl_pinjam}}</td>
           <td>{{$box->Kembali['tgl_kembali']}}</td>
           <td>
            @if( $box->status == "Pending" )
                <span class="badge badge-warning btn-sm">Pending</span>
               @elseif ( $box->status == "Accept" )
                <span class="badge badge-success btn-sm"><i class="fas fa-check"> Accept</i></span>
               @else
                <span class="badge badge-danger btn-sm">Rejected</span>
               @endif
           </td>
           <td>
             @if($box->status == "Pending")
             <form class="d-inline" method="post" action="{{url('/sm/user/destroy')}}/{{$box->id_pinjam}}">
              {{ method_field('DELETE')}}
              {{csrf_field()  }}
              <button type="submit" onclick="return confirm('Apakah Anda Yakin ?')" class="text-light btn-sm btn btn-danger btn-sm"><i class="fa fa-trash mr-2"></i>Delete</button>
            </form>
             @elseif($box->status == "Rejected")
             {{-- <i href="{{ url('/user/barang/exportpdf') }}/{{$box->id_pinjam}}" class="btn btn-danger float-right mr-2" onclick="return confirm('Cetak PDF?');" target="_blank"><i class="fas fa-print"></i></i> --}}
             @else
             <a href="{{ url('/user/barang/exportpdf') }}/{{$box->id_pinjam}}" class="btn btn-danger float-right mr-2" onclick="return confirm('Cetak PDF?');" target="_blank"><i class="fas fa-print"></i></a>
             <a href="" class="btn btn-secondary btn-sm" data-target="#kembali_{{$box->id_barang}}" data-toggle="modal">Kembali</a>
      </div>
    </div>
  </div>

     {{-- @foreach($barang as $box) --}}
  <div class="modal fade" id="kembali_{{$box->id_barang}}" tabindex="-1" role="dialog" aria-labelledby="kembali" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="kembali">Peminjaman</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        {{-- Form Input --}}
        <div class="container">
          <div class="row justify-content-center">
            <div class="col">
              
                <form method="post" action="{{url('/kembali/store')}}">
                {{csrf_field()}}
                
              <input type="hidden" name="id_barang" value="{{$box->id_barang}}"> 
              <input type="hidden" name="id_kategori" value="{{$box->Kategori['id_kategori']}}">
              <input type="hidden" name="id_pinjam" value="{{$box->Pinjam['id_pinjam']}}">
              <div class="modal-body">Yakin ingin dikembalikan ?</div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Ajukan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endif
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
<!-- /.container-fluid -->

      {{-- </div>
    </div>
  </div>
</div> --}}



@endsection