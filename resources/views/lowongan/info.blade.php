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
        <b>Tersedia</b> <p class="pull-right">{{ $lowongan->tersedia }}</p>
      </li>
    </ul>
      @if(Auth::user()->level=="1")
      @if($lamaran == null)
        <a href="/lamaran/{{$lowongan->id}}/create" class="
          @if(date('d/m/Y') <= Carbon\Carbon::parse($lowongan->tanggal_akhir)->format('d/m/Y')) 
          
          @if($lowongan->tersedia >= 1)
          @else
          disabled
          @endif
          @else
          disabled
          @endif btn btn-block btn-primary"><b>Ajukan Lamaran</b></a>
      @else

      @endif
      @endif
      @if(Auth::user()->level=="0")
        <button type="submit" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal-danger">
        <li class="fa  fa-bitbucket"></li><b> Hapus Lowongan</b>
        </button>
      @endif
        <a href="/lowongan" class="btn btn-block btn-default">
          <span class="glyphicon glyphicon-arrow-left"></span> Kembali
        </a>
  </div> 
  </div>
</div>

<div class="col-md-8">
  <div class="box box-info">
    <div class="box-header with-border">
      <i class="fa fa-bullhorn"></i>
      <h3 class="box-title">Deskripsi</h3>
      <small class="pull-right">Post : {{Carbon\Carbon::parse($lowongan->tanggal_dibuat)->format("d-m-Y")}}</small>
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
      <small class="pull-right">Berlaku Sampai : {{Carbon\Carbon::parse($lowongan->tanggal_akhir)->format("d-m-Y")}}</small>
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