@extends('layout.template')
@section('title', 'Lowongan Pekerjaan')
@section('content')
<?php $cek=0; ?>
@foreach($lowongan as $data2)
<?php
    $cek=$loop->iteration;
?>
@endforeach

@if($cek==0)
  <div class="alert alert-info alert-dismissible" style="margin-top: 10px">
    <h4><i class="icon fa fa-info"></i> Alert!</h4>
    Anda belum membuat lowongan pekerjaan.
  </div>
@else
@if(session('status'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Success!</h4>
    {{ session('status') }}
  </div>
@endif
<div class="row">
@foreach ($lowongan as $data) 
<div class="col-md-3">
<div class="box box-primary">
  <div class="box-body box-profile">
    <img class="profile-user-img img-responsive img-circle" src="{{ asset('template') }}/dist/img/perusahaan/{{ $data->perusahaan->gambar }}" alt="User profile picture">
    <h3 class="profile-username text-center">{{ $data->nama }}</h3>

    <p class="text-muted text-center">{{ $data->kategori->nama }}</p>

    <ul class="list-group list-group-unbordered">
      <li class="list-group-item">
        <b>Tanggal Upload</b> <a class="pull-right">{{ $data->tanggal_dibuat }}</a>
      </li>
      <li class="list-group-item">
        <b>Berlaku Sampai</b> <a class="pull-right">{{ $data->tanggal_akhir }}</a>
      </li>
    </ul>

    <a href="/detaillowongan/{{ $data->id }}" class="btn btn-primary btn-block"><b>Detail</b></a>
  </div>
</div>
</div>
@endforeach
@endif
</div>
@endsection