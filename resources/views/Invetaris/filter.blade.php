@foreach($barang as $b)
@if($b->stok == 0)
@else
<tr> 
<td>{{$b->nama_barang}}</td> 
<td>{{$b->Kategori['nama_kategori']}}</td>
<td>{{$b->kondisi}}</td>
<td>
<form action="{{ url('/pengajuan/store') }}/{{$b->id_barang}}" method="POST">
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