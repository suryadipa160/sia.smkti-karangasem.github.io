@extends('layout.template')
@section('title', 'Edit Data Alumni')
@section('content')
<div class="row">
<div class="col-md-6">
<div class="box box-primary">
    <div class="box-body box-profile">
    	<a href="/alumni/{{ $alumni->user_id  }}" class="btn btn-flat btn-default">
				<span class="glyphicon glyphicon-arrow-left"></span> Kembali
			</a>
            <form role="form" method="post" action="/alumni/{{ $alumni->id }}" enctype="multipart/form-data">
              @method('patch')
              @csrf
              <div class="box-body">
                <div class="form-group @error('nis') has-error @enderror" style="width: 300px">
                  <label for="nis">Nomor Induk Siswa</label>
                  <input type="text" class="form-control" name="nis" placeholder="Masukkan Nomor Induk Siswa" 
                  value="{{ $alumni->nis }}">
                  @error('nis')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('nama') has-error @enderror">
                  <label for="nama">Nama Siswa</label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama"
                  value="{{ $alumni->nama }}">
                  @error('nama')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('alamat') has-error @enderror">
                  <label for="alamat">Alamat</label>
                  <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat"
                  value="{{ $alumni->alamat }}">
                  @error('alamat')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('tanggal_lahir') has-error @enderror">
                  <label for="tanggal_lahir">Tanggal Lahir</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" id="datepicker" name="tanggal_lahir" class="form-control" placeholder="Masukkan tanggal" value="{{ \Carbon\Carbon::parse($alumni->tanggal_lahir)->format('Y/m/d') }}">
                  @error('tanggal_lahir')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('agama') has-error @enderror" style="width: 300px">
                  <label for="agama">Agama</label>
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="agama">
                  {{ $agama=$alumni->agama }}
                  <option selected="selected" value="">Pilih Agama</option>
                  <option @if($agama=="Islam") selected @endif value="Islam">Islam</option>
                  <option @if($agama=="Kristen") selected @endif value="Kristen">Kristen</option>
                  <option @if($agama=="Katolik") selected @endif value="Katolik">Katolik</option>
                  <option @if($agama=="Hindu") selected @endif value="Hindu">Hindu</option>
                  <option @if($agama=="Budha") selected @endif value="Budha">Budha</option>
                  <option @if($agama=="Khonghucu") selected @endif value="Khonghucu">Khonghucu</option>
               	  </select>
               	  @error('agama')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('jenis_kelamin') has-error @enderror" style="width: 300px">
                  <label for="jenis_kelamin">Jenis Kelamin</label><br>
                  <input @if($alumni->jenis_kelamin=="Laki - laki") checked @endif type="radio" name="jenis_kelamin" value="Laki - laki" style="margin-left: 20px">
                  <span>Laki - Laki</span><br>
                  <input @if($alumni->jenis_kelamin=="Perempuan") checked @endif type="radio" name="jenis_kelamin" value="Perempuan" style="margin-left: 20px">
                  <span>Perempuan</span>
                  @error('jenis_kelamin')<br><i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('jurusan') has-error @enderror" style="width: 300px">
                  <label for="jurusan">Jurusan</label>
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="jurusan">
                  {{ $jurusan=$alumni->jurusan }}
                  <option selected="selected" value="">Pilih Jurusan</option>
                  <option @if($jurusan=="Rekayasa Perangkat Lunak") selected @endif value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                  <option @if($jurusan=="Multimedia") selected @endif value="Multimedia">Multimedia</option>
                  <option @if($jurusan=="Teknik Komputer dan Jaringan") selected @endif value="Teknik Komputer dan Jaringan">Teknik Komputer dan Jaringan</option>
                  <option @if($jurusan=="Akuntansi") selected @endif value="Akuntansi">Akuntansi</option>
                  <option @if($jurusan=="Akomodasi Perhotelan") selected @endif value="Akomodasi Perhotelan">Akomodasi Perhotelan</option>
               	  </select>
               	  @error('jurusan')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('lulusan') has-error @enderror" style="width: 300px">
                  <label for="lulusan">Lulusan</label>
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="lulusan">
                  <option selected="selected" value="">Pilih Lulusan</option>
                  	{{ $now=date('Y') }}
                  		@for ($lulusan=2017; $lulusan <= $now ; $lulusan++)
                  			<option @if($lulusan==$alumni->lulusan) selected @endif value="{{ $lulusan }}">{{ $lulusan}}</option>
                  		@endfor
               	  </select>
               	  @error('lulusan')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
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
</div>
</div>
<script type="text/javascript">
  $('.date').datepicker({
      format: 'dd/mm/yyyy',
      autoclose: 'true'
    })
  $('#date').datepicker({
      format: 'yyyy/mm/dd',
      autoclose: 'true'
    })
</script>
@endsection