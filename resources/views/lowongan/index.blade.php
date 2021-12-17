@extends('layout.template')
@if(Auth::user()->level=="0")
@section('title', 'Data Lowongan Pekerjaan')
@endif
@if(Auth::user()->level=="1")
@section('title', 'Daftar Lowongan Pekerjaan')
@endif
@section('content')
<div class="row">
  @if(session('success'))
    <div class="alert alert-success alert-dismissible" style="margin-top: 10px">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Alert!</h4>
        {{ session('success') }}
    </div>
  @endif
<div class="col-6 col-sm-7">
@foreach ($lowongan as $data) 
<div class="box box-primary">
  <div class="box-body box-profile">
  <div class="box-header with-border">

    <h3 class="box-title">{{$data->nama}}</h3>
    <small class="pull-right">Post : {{Carbon\Carbon::parse($data->tanggal_dibuat)->format("d-m-Y")}}</small>
  </div>
    <table class="table table-bordered" id="example1">
        <tr>
          <td rowspan="4"><img class="profile-user-img img-responsive" src="{{ asset('template') }}/dist/img/perusahaan/{{ $data->perusahaan->gambar }}" alt="User profile picture"></td>
        </tr>
        <tr>
          <td>Perusahaan</td>
          <td>{{ $data->perusahaan->nama }}</td>
        </tr>
        <tr>
          <td>Kategori</td>
          <td>{{ $data->kategori->nama }}</td>
        </tr>
        <tr>
          <td>Tersedia</td>
          <td>{{ $data->tersedia }}</td>
        </tr>
        <tr>
          <td colspan="3">Alamat : {{ $data->perusahaan->alamat}}</td>
        </tr>
      </table>
      <small class="pull-left">Berlaku Sampai : {{Carbon\Carbon::parse($data->tanggal_akhir)->format("d-m-Y")}}</small>
    <a href="/detail/{{ $data->id }}" class="btn btn-flat btn-default pull-right">
      <li class="fa fa-eye"></li> Detail
    </a>
  </div>
</div>

@endforeach
<?php $cek=0; ?>
@foreach($lowongan as $data2)
  <?php
    $cek=$loop->iteration;
  ?>
@endforeach

@if($cek==0)
  <div class="alert alert-info alert-dismissible" style="margin-top: 10px">
    <h4><i class="icon fa fa-info"></i> Alert!</h4>
    Belum ada Lowongan Pekerjaan.
  </div>
@endif

@if($cek>0)
  {{$lowongan->links()}}
@endif

</div>

@if(session('status'))
<div class="col-md-4 pull-right">
  <div class="box box-default">
    <div class="box-body">
      <i class="fa fa-search"></i><span> {{ session('status') }}</span>
    </div>    
  </div>
</div>
@endif
<div class="col-6 col-sm-4 pull-right fixed-top ">
    <div class="box box-primary">
      <div class="box-header with-border">
        <i class="fa fa-check-circle-o"></i>

        <h3 class="box-title">Kategori</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <ul>
          @foreach($kategori as $kate)
            <a href="/lowongan/kategori/{{$kate->id}}">{{ $kate->nama }}</a><hr>
          @endforeach
        </ul>
      </div>
      <!-- /.box-body -->
    </div>
    <div class="box box-primary">
      <div class="box-header with-border">
        <i class="fa fa-industry"></i>

        <h3 class="box-title">Perusahaan</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <ul>
          @foreach($perusahaan as $peru)
            <a href="/lowongan/perusahaan/{{$peru->id}}">{{ $peru->nama }}</a><hr>
          @endforeach
        </ul>
      </div>
      <!-- /.box-body -->
    </div>
</div>
</div>
@endsection