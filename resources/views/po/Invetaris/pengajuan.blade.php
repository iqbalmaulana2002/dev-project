@extends('templates/template-po')

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
<a href="{{url('/po/invetaris')}}" class="btn btn-warning mb-2">Kembali</a>
<div class="row">
  <div class="col-3">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <label class="input-group-text" for="inputGroupSelect01">Categori</label>
      </div>
      <select class="custom-select" name="kategori" id="kategori_name">
        <option selected value="">Choose Kategori</option>
        @foreach ($kategori as $item)
        <option value={{$item->id_kategori}}>{{$item->nama_kategori}}</option>
        @endforeach
      </select>
    </div>
  </div>
</div>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">

    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" height="20px" cellspacing="0">
          <thead>
            <tr align="center">
              <th>Nama Barang</th>
              <th>Nama Kategori</th>
              <th>Kondisi</th>  
              <th>Action</th>
            </tr>
          </thead>
      
          <tbody id="barang">
        @foreach($barang as $b)
        @if($b->stok == 0)
        @else
           <tr align=""> 
           <td>{{$b->nama_barang}}</td> 
           <td>{{$b->Kategori['nama_kategori']}}</td>
           <td>{{$b->kondisi}}</td>
           <td>
            <form action="{{ url('/po/pengajuan/store') }}/{{$b->id_barang}}" method="POST">
              @csrf
              <input type="hidden" name="id_kategori" value="{{$b->Kategori['id_kategori']}}">
              <button class="btn btn-primary btn-sm" type="submit" name="pinjam">Pinjam</button>
            </form>
           {{-- <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#pinjam_{{$b->id_barang}}"><i class=""></i> Pinjam</a> --}}
           {{-- </td> --}}
           {{-- </tr> --}}
        {{-- @endforeach --}}
          {{-- </tbody> --}}
        {{-- </table> --}}
      </div>
    </div>
  </div>
</td>
</tr>
@endif
  @endforeach
</tbody>
</table>

</div>
<!-- /.container-fluid -->



@endsection