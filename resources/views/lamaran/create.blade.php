@extends('layout.template')
@section('title', 'Ajukan Lamaran')
@section('content')
<div class="row">
  <div class="col-md-4">
  <div class="box box-primary">
    <div class="box-body box-profile">
    <img class="img-responsive" src="{{ asset('template') }}/dist/img/perusahaan/{{ $lowongan->perusahaan->gambar }}" alt="User profile picture">
    <h5 class="profile-username text-center">{{ $lowongan->nama }}</h5>

    <ul class="list-group list-group-unbordered">
      <li class="list-group-item">
        <b>Perusahaan</b> <p class="pull-right">{{ $lowongan->perusahaan->nama }}</p>
      </li>
      <li class="list-group-item">
        <b>Kategori</b> <p class="pull-right">{{ $lowongan->kategori->nama }}</p>
      </li>
      <li class="list-group-item">
        <b>Berlaku Sampai</b> <p class="pull-right"> {{Carbon\Carbon::parse($lowongan->tanggal_akhir)->format("d-m-Y")}}</p>
      </li>
    </ul>
  </div>
  </div>
</div>

<div class="col-md-5">
  <div class="box box-primary">
    <div class="box-body box-profile">
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible" style="margin-top: 10px">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            {{ session('error') }}
        </div>
        @else
        @error('file')
        <div class="alert alert-danger alert-dismissible" style="margin-top: 10px">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            {{ $message }}
        </div>
        @else
        <div class="alert alert-info alert-dismissible" style="margin-top: 10px">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-info"></i> Alert!</h4>
          Pastikan lamaran sudah benar dan berformat PDF.
        </div>
        @enderror
        @endif
          <form role="form" method="post" action="/lamaran/{{ $lowongan->id }}" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
              <div class="form-group">
                <label for="nama">File Lamaran</label>
                <input type="file" id="lamaran" name="lamaran">
              </div>
              <div class="form-group">
                <label for="nama">File CV</label>
                <input type="file" id="cv" name="cv">
              </div>
              <div class="form-group">
                <label for="nama">File ijazah</label>
                <input type="file" id="ijazah" name="ijazah">
              </div>
            </div>
            <div class="box-footer">
              <a href="{{ url('/detail/'.$lowongan->id) }}" class="btn btn-flat btn-default">
                <span class="glyphicon glyphicon-arrow-left"></span> Kembali
              </a>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
          </div>
    </div>
  </div>
</div>
</div>
@endsection