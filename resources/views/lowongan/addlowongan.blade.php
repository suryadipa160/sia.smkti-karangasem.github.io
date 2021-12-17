@extends('layout.template')
@section('title', 'Buat Lowongan')
@section('content')
<div class="box box-primary">
    <div class="box-body box-profile">
        <div class="alert alert-info alert-dismissible" style="margin-top: 10px">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-info"></i> Alert!</h4>
        Silakan pastikan terlebih dahulu data profil anda sudah benar.
        </div>
        @if(session('status'))
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            {{ session('status') }}
          </div>
        @endif
            <form role="form" method="post" action="/lowongan/{{ Auth::user()->perusahaan->id }}">
              @csrf
              <div class="box-body">
                <div class="form-group @error('nama') has-error @enderror">
                  <label for="nama"><li class="fa fa-certificate"></li> Nama Lowongan</label>
                  <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Lowongan"
                  value="{{ old('nama') }}">
                  @error('nama')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('kategori') has-error @enderror" style="width: 300px">
                  <label for="kategori"><li class="fa fa-certificate"></li> Kategori Lowongan</label>
                  <select class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="kategori">
                  <option selected="selected" value="">Pilih Kategori</option>
                  @foreach( $kategori as $data )
                  <option value="{{$data->id}}">{{$data->nama}}</option>
                  @endforeach
                  </select>
                  @error('kategori')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('deskripsi') has-error @enderror">
                  <label for="deskripsi"><li class="fa fa-certificate"></li> Deskripsi</label>
                  <textarea id="editor1" name="deskripsi" rows="10" cols="80"></textarea>
                  @error('deskripsi')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('persyaratan') has-error @enderror">
                  <label for="persyaratan"><li class="fa fa-certificate"></li> Persyaratan</label>
                  <textarea id="editor2" name="persyaratan" rows="10" cols="80"></textarea>
                  @error('persyaratan')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group @error('tanggal_akhir') has-error @enderror">
                      <label for="tanggal_akhir"><li class="fa fa-certificate"></li> Berlaku Sampai :</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" id="date" name="tanggal_akhir" class="form-control">
                    </div>
                    @error('tanggal_akhir')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group @error('tersedia') has-error @enderror">
                    <label for="tersedia"><li class="fa fa-certificate"></li> Kuota lowongan</label>
                    <input type="text" class="form-control" name="tersedia" placeholder="Masukkan Kuota Lowongan">
                    @error('tersedia')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
    </div>
</div>
@endsection