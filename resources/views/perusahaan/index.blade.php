@extends('layout.template')
@section('title', 'Data Perusahaan')
@section('content')
@if(Auth::user()->level=="1")
<div class="box box-primary">
    <div class="box-body box-profile">
    	<?php $cek=0; ?>
@foreach($perusahaan as $data2)
<?php
    $cek=$loop->iteration;
?>
@endforeach

@if($cek==0)
  <div class="alert alert-info alert-dismissible" style="margin-top: 10px">
    <h4><i class="icon fa fa-info"></i> Alert!</h4>
    Belum ada data Perusahaan.
  </div>
@else
	<table id="example2" class="table table-bordered text-center">
		<thead class="bg-black color-palette">
			<tr>
				<th scope="col">Nama Perusahaan</th>
				<th scope="col">Logo</th>
				<th scope="col">Aksi</th>
			</tr>
			<tbody>
				@foreach( $perusahaan as $data)
				<tr>
					<td>{{ $data->nama }}</td>
					<td>
						<img class="profile-user-img" src="{{ asset('template') }}/dist/img/perusahaan/{{ $data->gambar }}">
					</td>
					<td>
						<a href="/perusahaan/{{ $data->user_id }}" class="btn btn-flat btn-info">
						<li class="fa fa-eye"></li> Detail
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</thead>
	</table>
	@endif
	</div>
</div>
@endif

@if(Auth::user()->level=="0")
<div class="box box-primary">
    <div class="box-body box-profile">
    	<?php $cek=0; ?>
@foreach($perusahaan as $data2)
<?php
    $cek=$loop->iteration;
?>
@endforeach

@if($cek==0)
  <div class="alert alert-info alert-dismissible" style="margin-top: 10px">
    <h4><i class="icon fa fa-info"></i> Alert!</h4>
    Belum ada data Perusahaan.
  </div>
@else
    	<a href="/perusahaan/create" class="btn btn-flat btn-success" style="margin-bottom: 5px">
    		<i class="fa  fa-plus-square"></i> Tambah Data
    	</a>
    	@if(session('status'))
    		<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                	{{ session('status') }}
             </div>
    	@endif
		<table id="example1" class="table table-bordered text-center">
			<thead class="bg-black color-palette">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Nama Perusahaan</th>
					<th scope="col">Logo</th>
					<th scope="col">Aksi</th>
				</tr>
				<tbody>
					@foreach( $perusahaan as $data)
					<tr>
						<th scope="row">{{ $loop->iteration }}</th>
						<td>{{ $data->nama }}</td>
						<td>
							<img class="profile-user-img" src="{{ asset('template') }}/dist/img/perusahaan/{{ $data->gambar }}">
						</td>
						<td>
							<a href="/perusahaan/{{ $data->user_id }}" class="btn btn-flat btn-info">
							<li class="fa fa-eye"></li> Detail
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</thead>
		</table>
		@endif
	</div>
	@endif
</div>
@endsection