@extends('layout.template')
@section('title', 'Edit Biodata')
@section('content')
<div class="box box-primary" style="width: 600px">
    <div class="box-body box-profile">
    	<a href="/profile/{{ $profile->user_id}}" class="btn btn-flat btn-default">
				<span class="glyphicon glyphicon-arrow-left"></span> Kembali
			</a>
            <form role="form" method="post" action="/profile/perusahaan/{{ $profile->id }}" enctype="multipart/form-data">
              @method('patch')
              @csrf
              <div class="box-body">
                <div class="form-group @error('nama') has-error @enderror">
                  <label for="nama">Nama Perusahaan</label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Perusahaan"
                  value="{{ $profile->nama }}">
                  @error('nama')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('tentang') has-error @enderror">
                  <label for="tentang">Tentang Perusahaan</label>
                  <textarea id="editor1" name="tentang" rows="10" cols="80">
                    {{ $profile->tentang }}
                  </textarea>
                  @error('jenis_usaha')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('alamat') has-error @enderror">
                  <label for="alamat">Alamat</label>
                  <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat"
                  value="{{ $profile->alamat }}">
                  @error('alamat')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('website') has-error @enderror">
                  <label for="website">Website</label>
                  <input type="text" class="form-control" id="website" name="website" placeholder="Masukkan Nama Website"
                  value="{{ $profile->website }}">
                  @error('website')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('no_telp') has-error @enderror">
                  <label for="no_telp">No Telepon</label>
                  <input type="text" class="form-control" id="website" name="no_telp" placeholder="Masukkan Nomor Telepon"
                  value="{{ $profile->no_telp }}">
                  @error('website')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Upload Gambar</label>
                  <input type="file" id="gambar" name="gambar">
                </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button> 
              </div>
            </form>
          </div>
    </div>
</div>
@endsection