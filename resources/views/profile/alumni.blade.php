@extends('layout.template')
@section('title', 'Edit Biodata')
@section('content')
<div class="row">
<div class="col-md-6">
<div class="box box-primary">
    <div class="box-body box-profile">
    	<a href="/profile/{{ $profile->user_id  }}" class="btn btn-flat btn-default">
				<span class="glyphicon glyphicon-arrow-left"></span> Kembali
			</a>
            <form role="form" method="post" action="/profile/alumni/{{ $profile->id }}" enctype="multipart/form-data">
              @method('patch')
              @csrf
              <div class="box-body">
                <div class="form-group @error('nama') has-error @enderror">
                  <label for="nama">Nama Siswa</label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama"
                  value="{{ $profile->nama }}">
                  @error('nama')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('alamat') has-error @enderror">
                  <label for="alamat">Alamat</label>
                  <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat"
                  value="{{ $profile->alamat }}">
                  @error('alamat')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('tanggal_lahir') has-error @enderror">
                  <label for="tanggal_lahir">Tanggal Lahir</label>
                  <input type="date" name="tanggal_lahir" class="form-control" placeholder="Masukkan tanggal (dd/mm/yyyy)" value="{{ $profile->tanggal_lahir }}">
                  @error('tanggal_lahir')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('agama') has-error @enderror" style="width: 300px">
                  <label for="agama">Agama</label>
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="agama">
                  {{ $agama=$profile->agama }}
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
                  <input @if($profile->jenis_kelamin=="Laki - laki") checked @endif type="radio" name="jenis_kelamin" value="Laki - laki" style="margin-left: 20px">
                  <span>Laki - Laki</span><br>
                  <input @if($profile->jenis_kelamin=="Perempuan") checked @endif type="radio" name="jenis_kelamin" value="Perempuan" style="margin-left: 20px">
                  <span>Perempuan</span>
                  @error('jenis_kelamin')<br><i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
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