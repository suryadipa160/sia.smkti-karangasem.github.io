@extends('layout.template')
@section('title', 'Data Kategori Lowongan')
@section('content')
<div class="box box-primary">
    <div class="box-body box-profile">
    	<?php $cek=0; ?>
@foreach($kategori as $data2)
<?php
    $cek=$loop->iteration;
?>
@endforeach

@if($cek==0)
  <div class="alert alert-info alert-dismissible" style="margin-top: 10px">
    <h4><i class="icon fa fa-info"></i> Alert!</h4>
    Belum ada data Kategori.
  </div>
@else
    	<a href="/kategori/tambah" class="btn btn-flat btn-success" style="margin-bottom: 5px">
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
					<th scope="col" width="70%">Nama Kategori</th>
					<th scope="col">Aksi</th>
				</tr>
				<tbody>
					@foreach( $kategori as $data)
					<tr>
						<th scope="row">{{ $loop->iteration }}</th>
						<td>{{ $data->nama }}</td>
						<td>
							<a href="/kategori/edit/{{ $data->id }}" class="btn btn-flat btn-primary">
							<li class="fa fa-pencil"></li> Edit
							</a>
							<button type="submit" class="btn btn-flat btn-danger" data-toggle="modal" data-target="#modal-danger"><li class="fa  fa-bitbucket"></li> Hapus</button>
						</td>
					</tr>
					@endforeach
				</tbody>
			</thead>
		</table>
		@endif
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
        <form action="/kategori/{{ $data->id }}" method="post">
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