@extends('layout.template')
@section('title', 'Profile')
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
<div class="col-md-5">
	<div class="box box-primary">
        <div class="box-body box-profile">
        	<table class="table table-bordered">
        		@if(Auth::user()->level=="1")
        		<tr>
					<th style="width: 120px;">NIS</th>
					<td>{{ $profile->alumni->nis }}</td>
				</tr>
				<tr>
					<th>Nama</th>
					<td>{{ $profile->alumni->nama }}</td>
				</tr>
				<tr>
					<th>Alamat</th>
					<td>{{ $profile->alumni->alamat }}</td>
				</tr>
				<tr>
					<th>Tanggal Lahir</th>
					<td>{{ Carbon\Carbon::parse($profile->alumni->tanggal_lahir)->format('d/m/Y') }}</td>
				</tr>
				<tr>
					<th>Agama</th>
					<td>{{ $profile->alumni->agama }}</td>
				</tr>
				<tr>
					<th>Jenis Kelamin</th>
					<td>{{ $profile->alumni->jenis_kelamin }}</td>
				</tr>
				<tr>
					<th>Jurusan</th>
					<td>{{ $profile->alumni->jurusan }}</td>
				</tr>
				<tr>
					<th>Lulusan</th>
					<td>{{ $profile->alumni->lulusan }}</td>
				</tr>
				<tr>
					<th>Email</th>
					<td>{{ $profile->email }}</td>
				</tr>
				<tr>
					<th>Username</th>
					<td>{{ $profile->username }}</td>
				</tr>
			</table>
		<a href="alumni/edit/{{ $profile->alumni->id }}" class="btn btn-flat btn-primary pull-right">
			<li class="fa fa-pencil"></li> Update Biodata
		</a>
		<a href="akun/edit/{{ $profile->id }}" class="btn btn-flat btn-success pull-left">
			<li class="fa fa-pencil"></li> Update Akun
		</a>
        </div>
    </div>
</div>

<div class="col-md-3">
	<div class="box box-primary">
  		<div class="box-body box-profile">
    		<img class="img-responsive" src="{{ asset('template') }}/dist/img/alumni/{{ $profile->alumni->gambar }}" alt="User profile picture">
  		</div>
	</div>

	<div class="box box-primary">
  		<div class="box-header with-border">
    		<i class="fa fa-archive"></i>
    	<h3 class="box-title">Lamaran</h3>
  	</div>

  	<div class="box-body box-profile">
  	@if($lamaran->isEmpty())
  		Belum mengajukan lamaran
  	@else
  	<table class="table table-bordered">
  	@foreach($lamaran as $data)
  		<tr>
  			<td>
  				<ul class="list-unstyled">
  					<a href="/detail/{{ $data->lowongan->id }}" class="btn-block">
  						<li> <span>{{ $data->lowongan->nama }}</span></li>
  					</a>
  				</ul>
  			</td>
  		</tr>
  	@endforeach
  	</table>
  	@endif
  	</div>
</div>
</div>
<div class="col-md-4">
  	<div class="box box-info">
  		<div class="box-header with-border">
  			<i class="fa fa-envelope-o"></i>
  		    <h3 class="box-title">Kesan dan Pesan Anda</h3>
  		</div>
  		  <!-- /.box-header -->
  		  	<div class="box-body">
  		  	{!! $profile->alumni->pesan !!}
  		  	</div>
  		  <!-- /.box-body -->
  	</div>
  		<div class="box box-info">
  		  <div class="box-header with-border">
  		    <i class="fa fa-check-square"></i>
  		    <h3 class="box-title">Status Anda</h3>
  		  </div>
  		  <!-- /.box-header -->
  		  <div class="box-body">
  		  	{{ $profile->alumni->status }}
  		  </div>
  		  <!-- /.box-body -->
  		</div>
  	</div>
				@endif
				@if(Auth::user()->level=="2")
				<tr>
					<th style="width: 150px;">Nama Perusahaan</th>
					<td>{{ $profile->perusahaan->nama }}</td>
				</tr>
				<tr>
					<th>Alamat</th>
					<td>{{ $profile->perusahaan->alamat }}</td>
				</tr>
				<tr>
					<th>Website</th>
					<td>{{ $profile->perusahaan->website }}</td>
				</tr>
				<tr>
					<th>No Telepon</th>
					<td>{{ $profile->perusahaan->no_telp }}</td>
				</tr>
				<tr>
					<th>Email</th>
					<td>{{ $profile->email }}</td>
				</tr>
				<tr>
					<th>Username</th>
					<td>{{ $profile->username }}</td>
				</tr>
			</table>
        </div>
    </div>
    <div class="box box-info">
  		<div class="box-header with-border">
  			<i class="fa fa-industry"></i>
  		    <h3 class="box-title">Tentang Perusahaan</h3>
  		</div>
  		  <!-- /.box-header -->
  		  	<div class="box-body">
  		  	{!! $profile->perusahaan->tentang !!}
  		  	<a href="perusahaan/edit/{{ $profile->perusahaan->id }}" class="btn btn-flat btn-primary pull-right">
				<li class="fa fa-pencil"></li> Update Biodata
			</a>
			<a href="akun/edit/{{ $profile->id }}" class="btn btn-flat btn-success pull-left">
				<li class="fa fa-pencil"></li> Update Akun
			</a>
  		  	</div>
  		  <!-- /.box-body -->
  	</div>
</div>

<div class="col-md-3">
	<div class="box box-primary">
  		<div class="box-body box-profile">
    		<img class="img-responsive" src="{{ asset('template') }}/dist/img/perusahaan/{{ $profile->perusahaan->gambar }}" alt="User profile picture">
  		</div>
	</div>
  </div>
			@endif
</div>
@endsection