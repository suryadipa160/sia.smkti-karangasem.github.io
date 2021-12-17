@extends('layout.template')
@section('title', 'Detail Data Alumni')
@section('content')
<div class="row">
	<div class="col-md-3">
		<div class="box box-primary">
  			<div class="box-body box-profile">
   		 		<img class="img-responsive" src="{{ asset('template') }}/dist/img/alumni/{{ $alumni->alumni->gambar }}" alt="User profile picture">
  			</div>
		</div>
  		<div class="box box-info">
  		  <div class="box-header with-border">
  		    <i class="fa fa-check-square"></i>
  		    <h3 class="box-title">Status Alumni</h3>
  		  </div>
  		  <!-- /.box-header -->
  		  <div class="box-body">
  		  	{{ $alumni->alumni->status }}
  		  </div>
  		  <!-- /.box-body -->
  		</div>
	</div>
	
	<div class="col-md-5">
	<div class="box box-primary">
        <div class="box-body box-profile">
        	<table class="table table-bordered">
				<tr>
					<td style="width: 120px;">Nis</td>
					<td>{{ $alumni->alumni->nis }}</td>
				</tr>
				<tr>
					<td>Nama</td>
					<td>{{ $alumni->alumni->nama }}</td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td>{{ $alumni->alumni->alamat }}</td>
				</tr>
				<tr>
					<td>Tanggal Lahir</td>
					<td>{{ Carbon\Carbon::parse($alumni->alumni->tanggal_lahir)->format('d/m/Y') }}</td>
				</tr>
				<tr>
					<td>Agama</td>
					<td>{{ $alumni->alumni->agama }}</td>
				</tr>
				<tr>
					<td>Jenis Kelamin</td>
					<td>{{ $alumni->alumni->jenis_kelamin }}</td>
				</tr>
				<tr>
					<td>Jurusan</td>
					<td>{{ $alumni->alumni->jurusan }}</td>
				</tr>
				<tr>
					<td>Lulusan</td>
					<td>{{ $alumni->alumni->lulusan }}</td>
				</tr>
				<tr>
					<td>Email</td>
					<td>{{ $alumni->email }}</td>
				</tr>
				@if(Auth::user()->level=="0")
				<tr>
					<td>Terakhir Diubah</td>
					<td>{{ Carbon\Carbon::parse($alumni->alumni->updated_at)->format("d-m-Y") }}</td>
				</tr>
				@endif
			</table>
			@if(Auth::user()->level=="1")
			<a href="{{ url('/alumni/data') }}" class="btn btn-flat btn-default">
				<span class="glyphicon glyphicon-arrow-left"></span> Kembali
			</a>
			@else
			<a href="{{ url('/alumni') }}" class="btn btn-flat btn-default">
				<span class="glyphicon glyphicon-arrow-left"></span> Kembali
			</a>
			@endif
			@if(Auth::user()->level=="0")
			<button type="submit" class="btn btn-flat btn-danger pull-right" data-toggle="modal" 
			data-target="#modal-danger" style="margin-left: 10px">
				<li class="fa  fa-bitbucket"></li> Delete
			</button>
			<a href="{{ $alumni->alumni->id }}/edit" class="btn btn-flat btn-primary pull-right">
				<li class="fa fa-pencil"></li> Edit
			</a>
			@endif
        </div>
    </div>
	</div>
	<div class="col-md-4">
  		<div class="box box-info">
  		  <div class="box-header with-border">
  		    <i class="fa fa-envelope-o"></i>
  		    <h3 class="box-title">Kesan dan Pesan Alumni</h3>
  		  </div>
  		  <!-- /.box-header -->
  		  <div class="box-body">
  		  	{!! $alumni->alumni->pesan !!}
  		  </div>
  		  <!-- /.box-body -->
  		</div>
	</div>
</div>
<div class="row">

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
        		<form action="{{ $alumni->alumni->id }}" method="post">
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