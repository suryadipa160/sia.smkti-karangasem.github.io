@extends('layout.template')
@section('title', 'Edit Lowongan')
@section('content')
<div class="box box-primary">
    <div class="box-body box-profile">
      <a href="/detaillowongan/{{ $lowongan->id}}" class="btn btn-flat btn-default">
        <span class="glyphicon glyphicon-arrow-left"></span> Kembali
      </a>
        <form role="form" method="post" action="/lowongan/{{ $lowongan->id }}">
          @method('patch')
          @csrf
          <div class="box-body">
            <div class="form-group @error('nama') has-error @enderror">
              <label for="nama"><li class="fa fa-certificate"></li> Nama Lowongan</label>
              <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Lowongan"
              value="{{ $lowongan->nama }}">
              @error('nama')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
            </div>
            <div class="form-group @error('kategori') has-error @enderror" style="width: 300px">
              <label for="kategori"><li class="fa fa-certificate"></li> Kategori Lowongan</label>
              <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="kategori">
              <option selected="selected" value="">Pilih Kategori</option>
              @foreach( $kategori as $data )
              <option @if($lowongan->kategori->id=="$data->id") selected @endif value="{{$data->id}}">{{$data->nama}}</option>
              @endforeach
              </select>
              @error('kategori')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
            </div>
            <div class="form-group @error('deskripsi') has-error @enderror">
              <label for="deskripsi"><li class="fa fa-certificate"></li> Deskripsi</label>
              <textarea id="editor1" name="deskripsi" rows="10" cols="80">
                {{ $lowongan->deskripsi }}
              </textarea>
              @error('deskripsi')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
            </div>
            <div class="form-group @error('persyaratan') has-error @enderror">
              <label for="persyaratan"><li class="fa fa-certificate"></li> Persyaratan</label>
              <textarea id="editor2" name="persyaratan" rows="10" cols="80">
                {{ $lowongan->persyaratan }}
              </textarea>
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
                  <input type="text" id="date" name="tanggal_akhir" class="form-control" value="{{$lowongan->tanggal_akhir}}">
                  </div>
                  @error('tanggal_akhir')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group @error('tersedia') has-error @enderror">
                  <label for="tersedia"><li class="fa fa-certificate"></li> Kuota lowongan</label>
                  <input type="text" class="form-control" name="tersedia" placeholder="Masukkan Kuota Lowongan" value="{{ $lowongan->tersedia }}">
                  @error('tersedia')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
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