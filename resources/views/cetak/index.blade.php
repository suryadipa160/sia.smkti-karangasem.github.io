@extends('layout.template')
@section('title', 'Cetak Laporan '.$jenis)
@section('content')
<div class="row">
  <div class="col-md-4">
<div class="box box-primary">
    <div class="box-body box-profile">
        <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-info"></i> Alert!</h4>
        {{ $message }}
        </div>
        <h4 class="text-center">Tentukan Tanggal</h4>
            <form role="form" method="post" action="/cetak">
              @csrf
              <input type="text" name="jenis" class="hidden" value="{{ $jenis }}">
              <div class="box-body">
                <div class="form-group @error('tanggal_awal') has-error @enderror">
                  <label for="tanggal_akhir"><li class="fa fa-certificate"></li> Dari Tanggal :</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" id="datepicker" name="tanggal_awal" class="form-control" placeholder="Masukkan tanggal">
                  </div>
                  @error('tanggal_awal')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('tanggal_akhir') has-error @enderror">
                  <label for="tanggal_akhir"><li class="fa fa-certificate"></li> Sampai Tanggal :</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" id="datepicker2" name="tanggal_akhir" class="form-control" placeholder="Masukkan tanggal" value="{{ \Carbon\Carbon::now()->format('Y/m/d') }}">
                  </div>
                  @error('tanggal_akhir')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Tampilkan</button>
              </div>
            </form>
          </div>
    </div>
</div>
</div>
</div>
@endsection