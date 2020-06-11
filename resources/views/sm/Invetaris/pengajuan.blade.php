@extends('templates/template-sm')

@section('title', 'Data Barang')

@section('content')


@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<div class="container-fluid">  
  <h1 class="h3 mb-2 text-gray-800">Data Barang</h1>
  <a href="{{url('/sm/invetaris')}}" class="btn btn-warning mb-2">Kembali</a>
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
          </div>
        </div>
        <table class="table table-bordered" id="dataTable" width="100%" height="20px" cellspacing="0">
          <thead class="thead-dark">
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
           <tr> 
           <td>{{$b->nama_barang}}</td> 
           <td>{{$b->Kategori['nama_kategori']}}</td>
           <td>{{$b->kondisi}}</td>
           <td>
            <form action="{{ url('/sm/pengajuan/store') }}/{{$b->id_barang}}" method="POST">
              @csrf
              <input type="hidden" name="id_kategori" value="{{$b->Kategori['id_kategori']}}">
              <button class="btn btn-primary btn-sm" type="submit" name="pinjam">Pinjam</button>
            </form>
           {{-- <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#pinjam_{{$b->id_barang}}"><i class=""></i> Pinjam</a> --}}
      </div>
    </div>
  </div>

  {{-- @foreach($barang as $box) --}}
  {{-- <div class="modal fade" id="pinjam_{{$b->id_barang}}" tabindex="-1" role="dialog" aria-labelledby="pinjam" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pinjam">Peminjaman</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        
        <div class="container">
          <div class="row justify-content-center">
            <div class="col">
              
              <form method="post" action="{{url('/pengajuan/store')}}">
                {{csrf_field()}}
                
              <input type="hidden" name="id_barang" value="{{$b->id_barang}}"> 
              <input type="hidden" name="id_kategori" value="{{$b->Kategori['id_kategori']}}">
              
            
                <div class="form-group">
                  <label for="keterangan">Keterangan </label>
                <input type="text" class="form-control @error('keterangan') is-invalid @enderror" placeholder="" name="keterangan" value="">
                  @error('keterangan')
                  <div class="invalid-feedback">{{$message}}</div>
                  @enderror
                </div>
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
  </div> --}}
</td>
</tr>
@endif
  @endforeach
</tbody>
</table>

</div>
@endsection