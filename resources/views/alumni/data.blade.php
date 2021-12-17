@extends('layout.template')
@section('title', 'Daftar Alumni')
@section('content')
<div class="box box-primary">
    <div class="box-body box-profile">
    	@if(Auth::user()->level=="0")
    	<a href="/alumni/create" class="btn btn-flat btn-success" style="margin-bottom: 5px">Tambah Data</a>
    	@else

    	@endif

<?php $cek=0; ?>
@foreach($alumni as $data2)
<?php
    $cek=$loop->iteration;
?>
@endforeach

@if($cek==0)
  <div class="alert alert-info alert-dismissible" style="margin-top: 10px">
    <h4><i class="icon fa fa-info"></i> Alert!</h4>
    Belum ada data Alumni.
  </div>
@else
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
					<th>Nis</th>
					<th>Nama</th>
					<th>Jurusan</th>
					<th>Lulusan</th>
					<th>Foto</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@foreach( $alumni as $data)
				<tr>
					<!-- <th scope="row">{{ $loop->iteration }}</th> -->
					<th>{{ $data->nis }}</td>
					<td>{{ $data->nama }}</td>
					<td>{{ $data->jurusan }}</td>
					<td>{{ $data->lulusan }}</td>
					<td>
						<img class="profile-user-img" src="{{ asset('template') }}/dist/img/alumni/{{ $data->gambar }}">
					</td>
					<td>
						<a href="/alumni/{{ $data->user_id }}" class="btn btn-flat btn-info">
							<li class="fa fa-eye"></li> Detail
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@endif
	</div>
</div>
@endsection