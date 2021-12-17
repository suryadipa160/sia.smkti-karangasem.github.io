@extends('layout.template')
@section('title', 'Detail Data Perusahaan')
@section('content')
<div class="row">
	<div class="col-md-3">
		<div class="box box-primary">
  			<div class="box-body box-profile">
    			<img class="img-responsive" src="{{ asset('template') }}/dist/img/perusahaan/{{ $perusahaan->perusahaan->gambar }}" alt="User profile picture">
  			</div>
		</div>
	</div>

	<div class="col-md-9">
  		<div class="box box-info">
  		  <div class="box-header with-border">
  		    <i class="fa fa-bullhorn"></i>
  		    <h3 class="box-title">Tentang Perusahaan</h3>
  		  </div>
  		  <!-- /.box-header -->
  		  <div class="box-body">
  		    {!! $perusahaan->perusahaan->tentang !!}
  		  </div>
  		  <!-- /.box-body -->
  		</div>
	</div>
</div>

<div class="row">
<div class="col-md-6">
	<div class="box box-primary">
        <div class="box-body box-profile">
        	<table class="table table-bordered">
				<tr>
					<td style="width: 150px;">Nama Perusahaan</td>
					<td>{{ $perusahaan->perusahaan->nama }}</td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td>{{ $perusahaan->perusahaan->alamat }}</td>
				</tr>
				<tr>
					<td>Website</td>
					<td>{{ $perusahaan->perusahaan->website }}</td>
				</tr>
				<tr>
					<td>Email</td>
					<td>{{ $perusahaan->email }}</td>
				</tr>

				<tr>
					<td>No Telepon</td>
					<td>{{ $perusahaan->perusahaan->no_telp }}</td>
				</tr>
				@if(Auth::user()->level=="0")
				<tr>
					<td>Terakhir Diubah</td>
					<td>{{ Carbon\Carbon::parse($perusahaan->perusahaan->updated_at)->format("d-m-Y") }}</td>
				</tr>
				@endif
			</table><br>
			<a href="{{ url('/perusahaan') }}" class="btn btn-flat btn-default">
				<span class="glyphicon glyphicon-arrow-left"></span> Kembali
			</a>
			@if(Auth::user()->level=="0")
			<button type="submit" class="btn btn-flat btn-danger pull-right" data-toggle="modal" 
			data-target="#modal-danger" style="margin-left: 10px">
				<li class="fa  fa-bitbucket"></li> Delete
			</button>
			<a href="{{ $perusahaan->perusahaan->id }}/edit" class="btn btn-flat btn-primary pull-right">
				<li class="fa fa-pencil"></li> Edit
			</a>
			@endif
			@if(Auth::user()->level=="1")
			<a href="/lowongan/perusahaan/cari/{{$perusahaan->perusahaan->id}}" class="btn btn-flat btn-primary pull-right">
				<li class="fa fa-suitcase"></li> Lihat Lowongan Pekerjaan
			</a>
			@endif
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
                <form action="/perusahaan/{{ $perusahaan->perusahaan->id }}/delete" method="post">
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