@extends('layout.template')
@section('title', 'Data Lamaran')
@section('content')
<?php $cek=0; ?>
@foreach($lamaran as $data2)
<?php
    $cek=$loop->iteration;
?>
@endforeach

@if($cek==0)
  <div class="alert alert-info alert-dismissible" style="margin-top: 10px">
    <h4><i class="icon fa fa-info"></i> Alert!</h4>
    Belum ada yang mengajukan lamaran.
  </div>
@else
@if(Auth::user()->level=="2")
	<div class="col-6 col-sm-7">
@foreach ($lamaran as $data) 
<div class="box box-primary">
  <div class="box-body box-profile">
  <div class="box-header with-border">

    <h3 class="box-title">{{$data->lowongan->nama}}</h3>
    
  </div>
    <table class="table table-bordered" id="example1">
        <tr>
          <td rowspan="4"><img class="profile-user-img img-responsive" src="{{ asset('template') }}/dist/img/alumni/{{ $data->alumni->gambar }}"></td>
        </tr>
        <tr>
          <td>Nama</td>
          <td>{{ $data->alumni->nama }}</td>
        </tr>
        <tr>
          <td>Jurusan</td>
          <td>{{ $data->alumni->jurusan }}</td>
        </tr>
        <tr>
          <td>Lulusan</td>
          <td>{{ $data->alumni->lulusan }}</td>
        </tr>
        <tr>
          <td colspan="3">
          	<a href="{{ asset('template') }}/dist/file/{{ $data->lamaran }}" class="btn btn-flat btn-success" download="{{ $data->lamaran }}">
				<li class="fa fa-check"></li> File Lamaran
			</a>
			<a href="{{ asset('template') }}/dist/file/{{ $data->cv }}" class="@if($data->cv == '-') disabled btn-danger @endif btn btn-flat btn-success" download="{{ $data->cv }}">
				<li class="fa @if($data->cv == '-') fa-ban @endif fa-check"></li> File CV
			</a>
			<a href="{{ asset('template') }}/dist/file/{{ $data->ijazah }}" class="@if($data->ijazah == '-') disabled btn-danger @endif btn btn-flat btn-success" download="{{ $data->ijazah }}">
				<li class="fa @if($data->ijazah == '-') fa-ban @endif fa-check"></li> File ijazah
			</a>
			<a href="/detaillowongan/{{ $data->lowongan->id }}" class="btn btn-flat btn-default pull-right">
      			<li class="fa fa-eye"></li> Detail Lowongan
    		</a>
          </td>
        </tr>
      </table>
    	
  </div>
</div>

@endforeach

	@else

<div class="box box-primary">
    <div class="box-body box-profile">
	<table id="example1" class="table table-bordered text-center">
			
		<thead class="bg-black color-palette">
			<tr>
				<th>No</th>
				<th>Alumni</th>
				<th>Lulusan</th>
				<th>Perusahaan</th>
				<th>Lowongan</th>
			</tr>
		</thead>
		<tbody>
			@foreach( $lamaran as $data)
			<tr>
				<th scope="row">{{ $loop->iteration }}</th>
				<td>
					<img class="profile-user-img" src="{{ asset('template') }}/dist/img/alumni/{{ $data->alumni->gambar }}"><br><br>
					{{ $data->alumni->nama }}
				</td>
				<td>{{ $data->alumni->lulusan }}</td>
				<td>{{ $data->perusahaan->nama }}</td>
				<td>{{ $data->lowongan->nama }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@endif
@endif
	</div>
</div>
@endsection