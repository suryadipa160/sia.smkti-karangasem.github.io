@extends('layout.template')
@section('title', 'Detail Lowongan Pekerjaan')
@section('content')
<div class="row">
  @if(session('status'))
      <div class="col-md-12">
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Success!</h4>
            {{ session('status') }}
        </div>
      </div>
      @endif
<div class="col-md-4">
  <div class="box box-primary">
    <div class="box-body box-profile">
    <img class="profile-user-img img-responsive img-circle" src="{{ asset('template') }}/dist/img/perusahaan/{{ $lowongan->perusahaan->gambar }}" alt="User profile picture">
    <h5 class="profile-username text-center">{{ $lowongan->nama }}</h5>

    <p class="text-muted text-center">{{ $lowongan->perusahaan->nama }}</p>

    <ul class="list-group list-group-unbordered">
      <li class="list-group-item">
        <b>Kategori</b> <p class="pull-right">{{ $lowongan->kategori->nama }}</p>
      </li>
      <li class="list-group-item">
        <b>Kuota Lowongan</b> <p class="pull-right">{{ $lowongan->tersedia }}</p>
      </li>
      <li class="list-group-item">
        <b>Tanggal Upload</b> <p class="pull-right">{{ $lowongan->tanggal_dibuat }}</p>
      </li>
      <li class="list-group-item">
        <b>Berlaku Sampai</b> <p class="pull-right">{{ $lowongan->tanggal_akhir }}</p>
      </li>
    </ul>
    <a href="/editlowongan/{{ $lowongan->id }}" class="btn btn-primary pull-right"><li class="fa fa-pencil"></li><b> Edit Lowongan</b></a>
    @if($jml_lamaran >=1)
    @else
    <button type="submit" class="btn btn-danger pull-left" data-toggle="modal" data-target="#modal-danger">
      <li class="fa  fa-bitbucket"></li><b> Hapus Lowongan</b>
    </button>
    @endif
  </div>
  </div>
</div>

<div class="col-md-8">
  <div class="box box-info">
    <div class="box-header with-border">
      <i class="fa fa-bullhorn"></i>
      <h3 class="box-title">Deskripsi</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      {!! $lowongan->deskripsi !!}
    </div>
    <!-- /.box-body -->
  </div>
</div>
<div class="col-md-8">
  <div class="box box-info">
    <div class="box-header with-border">
      <i class="fa fa-check"></i>

      <h3 class="box-title">Persyaratan</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      {!! $lowongan->persyaratan !!}
    </div>
    <!-- /.box-body -->
  </div>
</div>
</div>

<div class="modal modal-danger fade" id="modal-danger" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title"><i class="fa fa-warning"></i> Warning!</h4>
      </div>
      <div class="modal-body">
        <p>Apa anda yakin ingin menghapus data ini?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
        <form action="/hapuslowongan/{{ $lowongan->id }}" method="post">
          @method('delete')
          @csrf 
          <button type="submit" class="btn btn-outline">Delete</button>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection