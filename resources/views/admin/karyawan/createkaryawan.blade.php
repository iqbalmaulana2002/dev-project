@extends('templates/template-dasar')

@section('title', 'Registrasi Karyawan')

@section('content')

  <div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5 col-md-10 mx-auto">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Registrasi Karyawan</h1>
              </div>
              <form method="POST" action="{{ url('/registrasi') }}" class="user">
                @csrf
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="number" class="form-control form-control-user @error('nip') is-invalid @enderror" value="{{ old('nip') }}" id="nip" placeholder="NIP" name="nip" required>
                    @error('nip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user @error('nama') is-invalid @enderror" id="nama" placeholder="Nama" name="nama" value="{{ old('nama') }}" required>
                    @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user @error('tmp_lahir') is-invalid @enderror" id="tmp_lahir" placeholder="Tempat Lahir" name="tmp_lahir" value="{{ old('tmp_lahir') }}" required>
                    @error('tmp_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
                  <div class="col-sm-6">
                    <input type="date" class="form-control form-control-user @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir" placeholder="Tanggal Lahir" name="tgl_lahir" value="{{ old('tgl_lahir') }}" required>
                    @error('tgl_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" placeholder="Email" name="email" value="{{ old('email') }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
                  <div class="col-sm-6">
                    <input type="radio" class="form-check-input ml-2 @error('jenkel') is-invalid @enderror" id="Laki-laki" name="jenkel" value="Laki-laki"{{old('jenkel') == 'Laki-laki' ? 'checked' : ''}} required>
                    <label for="Laki-laki" class="ml-4">Laki-laki</label>
                    @error('jenkel') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <input type="radio" class="form-check-input ml-2 @error('jenkel') is-invalid @enderror" id="perempuan" name="jenkel" value="Perempuan"{{old('jenkel') == 'Perempuan' ? 'checked' : ''}} required>
                    <label for="perempuan" class="ml-4">Perempuan</label>
                    @error('jenkel') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <select id="id_stream" name="id_stream" class="form-control @error('id_stream') is-invalid @enderror">
                      <option value="">--Pilih Stream--</option>
                      @foreach ($stream as $s)
                        <option value="{{ $s->id }}"{{old('id_stream') == $s->id ? 'selected' : ''}}>{{ $s->stream }}</option>
                      @endforeach
                    </select>
                    @error('id_stream') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
                  <div class="col-sm-6">
                    <select id="id_pendidikan" name="id_pendidikan" class="form-control @error('id_pendidikan') is-invalid @enderror">
                      <option value="">--Pilih Pendidikan--</option>
                      @foreach ($pendidikan as $p)
                        <option value="{{ $p->id }}"{{old('id_pendidikan') == $p->id ? 'selected' : ''}}>{{ $p->pendidikan }}</option>
                      @endforeach
                    </select>
                    @error('id_pendidikan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="number" class="form-control form-control-user @error('thn_join') is-invalid @enderror" id="thn_join" placeholder="Tahun Join" name="thn_join" value="{{ old('thn_join') }}" required>
                    @error('thn_join') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
                  <div class="col-sm-6">
                    <input type="number" class="form-control form-control-user @error('no_telp') is-invalid @enderror" id="no_telp" placeholder="Nomor Telpon" name="no_telp" value="{{ old('no_telp') }}" required>
                    @error('no_telp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <select id="agama" name="agama" class="form-control @error('agama') is-invalid @enderror">
                      <option value="">--Pilih Agama--</option>
                      <option value="Islam"{{old('agama') == 'Islam' ? 'selected' : ''}}>Islam</option>
                      <option value="Kristen"{{old('agama') == 'Kristen' ? 'selected' : ''}}>Kristen</option>
                      <option value="Katholik"{{old('agama') == 'Katholik' ? 'selected' : ''}}>Katolik</option>
                      <option value="Hindu"{{old('agama') == 'Hindu' ? 'selected' : ''}}>Hindu</option>
                      <option value="Buddha"{{old('agama') == 'Buddha' ? 'selected' : ''}}>Buddha</option>
                      <option value="Konghucu"{{old('agama') == 'Konghucu' ? 'selected' : ''}}>Konghucu</option>
                    </select>
                    @error('agama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
                  <div class="col-sm-6">
                    <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="2" placeholder="Alamat" required>{{ old('alamat') }}</textarea>
                    @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password" required>
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user @error('password2') is-invalid @enderror" id="password2" placeholder="Konfirmasi Password" name="password2" required>
                    @error('password2') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <select id="id_role" name="id_role" class="form-control @error('id_role') is-invalid @enderror">
                      <option value="">--Pilih Role--</option>
                      @foreach ($role as $r)
                        <option value="{{ $r->id }}"{{old('id_role') == $r->id ? 'selected' : ''}}>{{ $r->role }}</option>
                      @endforeach
                    </select>
                    @error('id_role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
                  <div class="col-sm-6">
                    <select multiple="multiple" name="id_projek[]" id="id_projek" class="form-control @error('id_projek[]') is-invalid @enderror">
                      <option value="">--Pilih Projek--</option>
                      @foreach ($projek as $p)
                      <option value="{{ $p->id }}"{{old('id_projek[]') == $p->id ? 'selected' : ''}}>{{ $p->project }}</option>
                      @endforeach
                    </select>
                    @error('id_projek[]') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
                </div>
                <button type="submit" name="registasi" class="btn btn-primary btn-user btn-block">
                  Registrasi Akun
                </button>
                <div class="text-center">
                  <a href="{{ url('/login') }}" class="">Have an account? Login here</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @endsection