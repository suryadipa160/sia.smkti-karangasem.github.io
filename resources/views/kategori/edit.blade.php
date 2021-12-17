@extends('layout.template')
@section('title', 'Edit Kategori Lowongan')
@section('content')
<div class="box box-primary" style="width: 600px">
    <div class="box-body box-profile">
        <a href="{{ url('/kategori') }}" class="btn btn-flat btn-default">
        <span class="glyphicon glyphicon-arrow-left"></span> Kembali
        </a>
        <div class="alert alert-info alert-dismissible" style="margin-top: 10px">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-info"></i> Alert!</h4>
        Silakan masukkan data yang benar.
        </div>
            <form role="form" method="post" action="/kategori/{{ $kategori->id }}">
              @method('patch')
              @csrf
              <div class="box-body">
                <div class="form-group @error('nama') has-error @enderror">
                  <label for="nama">Nama Kategori</label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Kategori" value="{{ $kategori->nama }}">
                  @error('nama')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
    </div>
</div>
@endsection