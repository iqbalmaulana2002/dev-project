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