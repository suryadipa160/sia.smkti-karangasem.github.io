@extends('layout.template')
@section('title', 'Tambah Data Alumni')
@section('content')
<div class="box box-primary" style="width: 600px">
    <div class="box-body box-profile">
    		<a href="{{ url('/alumni') }}" class="btn btn-flat btn-default">
				<span class="glyphicon glyphicon-arrow-left"></span>
			  </a>
        <div class="alert alert-info alert-dismissible" style="margin-top: 10px">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-info"></i> Alert!</h4>
        Silakan masukkan data yang benar.
        </div>
            <form role="form" method="post" action="/alumni" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="form-group @error('nis') has-error @enderror" style="width: 300px">
                  <label for="nis">Nomor Induk Siswa</label>
                  <input type="text" class="form-control" name="nis" placeholder="Masukkan Nomor Induk Siswa" 
                  value="{{ old('nis') }}">
                  @error('nis')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('nama') has-error @enderror">
                  <label for="nama">Nama Siswa</label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama"
                  value="{{ old('nama') }}">
                  @error('nama')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('alamat') has-error @enderror">
                  <label for="alamat">Alamat</label>
                  <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat"
                  value="{{ old('alamat') }}">
                  @error('alamat')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('tanggal_lahir') has-error @enderror" style="width: 300px">
                  <label for="tanggal_lahir">Tanggal Lahir</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" id="datepicker" name="tanggal_lahir" class="date form-control" value="{{ old('tanggal_lahir') }}">
                  </div>
                  @error('tanggal_lahir')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('agama') has-error @enderror" style="width: 300px">
                  <label for="agama">Agama</label>
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="agama">
                  <option selected="selected" value="">Pilih Agama</option>
                  <option @if(old('agama')=="Islam") selected @endif value="Islam">Islam</option>
                  <option @if(old('agama')=="Kristen") selected @endif value="Kristen">Kristen</option>
                  <option @if(old('agama')=="Katolik") selected @endif value="Katolik">Katolik</option>
                  <option @if(old('agama')=="Hindu") selected @endif value="Hindu">Hindu</option>
                  <option @if(old('agama')=="Budha") selected @endif value="Budha">Budha</option>
                  <option @if(old('agama')=="Khonghucu") selected @endif value="Khonghucu">Khonghucu</option>
               	  </select>
               	  @error('agama')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('jenis_kelamin') has-error @enderror" style="width: 300px">
                  <label for="jenis_kelamin">Jenis Kelamin</label><br>
                  <input @if(old('jenis_kelamin')=="Laki - laki") checked @endif type="radio" name="jenis_kelamin" value="Laki - laki" style="margin-left: 20px">
                  <span>Laki - Laki</span><br>
                  <input @if(old('jenis_kelamin')=="Perempuan") checked @endif type="radio" name="jenis_kelamin" value="Perempuan" style="margin-left: 20px">
                  <span>Perempuan</span>
                  @error('jenis_kelamin')<br><i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('jurusan') has-error @enderror" style="width: 300px">
                  <label for="jurusan">Jurusan</label>
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="jurusan">
                  <option selected="selected" value="">Pilih Jurusan</option>
                  <option @if(old('jurusan')=="Rekayasa Perangkat Lunak") selected @endif value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                  <option @if(old('jurusan')=="Multimedia") selected @endif value="Multimedia">Multimedia</option>
                  <option @if(old('jurusan')=="Teknik Komputer dan Jaringan") selected @endif value="Teknik Komputer dan Jaringan">Teknik Komputer dan Jaringan</option>
                  <option @if(old('jurusan')=="Akuntansi") selected @endif value="Akuntansi">Akuntansi</option>
                  <option @if(old('jurusan')=="Akomodasi Perhotelan") selected @endif value="Akomodasi Perhotelan">Akomodasi Perhotelan</option>
               	  </select>
               	  @error('jurusan')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('lulusan') has-error @enderror" style="width: 300px">
                  <label for="lulusan">Lulusan</label>
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="lulusan">
                  <option selected="selected" value="">Pilih Lulusan</option>
                  	{{ $now=date('Y') }}
                  		@for ($lulusan=2017; $lulusan <= $now ; $lulusan++)
                  			<option @if($lulusan==old('lulusan')) selected @endif value="{{ $lulusan }}">{{ $lulusan}}</option>
                  		@endfor
               	  </select>
               	  @error('lulusan')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('email') has-error @enderror" style="width: 300px">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email"
                  value="{{ old('email') }}">
                  @error('email')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Upload Gambar</label>
                  <input type="file" id="gambar" name="gambar">
                </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
    </div>
</div>
@endsection