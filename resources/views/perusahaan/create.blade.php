@extends('layout.template')
@section('title', 'Tambah Data Perusahaan')
@section('content')
<div class="row">
<div class="col-md-6">
<div class="box box-primary">
    <div class="box-body box-profile">
        <a href="{{ url('/perusahaan') }}" class="btn btn-flat btn-default">
        <span class="glyphicon glyphicon-arrow-left"></span>
        </a>
        <div class="alert alert-info alert-dismissible" style="margin-top: 10px">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-info"></i> Alert!</h4>
          Silakan masukkan data yang benar.
        </div>
            <form role="form" method="post" action="/perusahaan" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="form-group @error('nama') has-error @enderror">
                  <label for="nama">Nama Perusahaan</label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Perusahaan"
                  value="{{ old('nama') }}">
                  @error('nama')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('tentang') has-error @enderror">
                  <label for="tentang">Tentang Perusahaan</label>
                  <textarea id="editor1" name="tentang" rows="10" cols="80">-</textarea>
                  @error('tentang')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('alamat') has-error @enderror">
                  <label for="alamat">Alamat</label>
                  <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat"
                  value="{{ old('alamat') }}">
                  @error('alamat')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('website') has-error @enderror">
                  <label for="website">Website</label>
                  <input type="text" class="form-control" id="website" name="website" placeholder="Masukkan Nama Website"
                  value="{{ old('website') }}">
                  @error('website')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('no_telp') has-error @enderror">
                  <label for="website">No Telepon</label>
                  <input type="text" class="form-control" id="website" name="no_telp" placeholder="Masukkan No Telepon"
                  value="{{ old('no_telp') }}">
                  @error('no_telp')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('email') has-error @enderror">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email"
                  value="{{ old('email') }}">
                  @error('email')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Upload Logo</label>
                  <input type="file" id="gambar" name="gambar">
                </div>
                <div class="form-group @error('username') has-error @enderror">
                  <label for="username">Username</label>
                  <input type="text" name="username" name="username" class="form-control" placeholder="Masukkan Username" value="{{ old('username') }}">
                  @error('username')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('password') has-error @enderror">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
                  @error('password')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('password_confirmation') has-error @enderror">
                  <label for="password">Konfirmasi Password</label>
                 <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password">
                  @error('password_confirmation')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
    </div>
</div>
</div>
</div>
@endsection