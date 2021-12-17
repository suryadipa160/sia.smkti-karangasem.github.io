@extends('layout.template')
@section('title', 'Cetak Laporan Data Alumni')
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
        <h4 class="text-center">Tentukan Lulusan</h4>
            <form role="form" method="post" action="/cetak">
              @csrf
              <div class="box-body">
                <div class="form-group @error('tanggal_akhir') has-error @enderror">
                  <label for="tanggal_akhir"><li class="fa fa-certificate"></li> Lulusan :</label>
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="lulusan">
                  <option selected="selected" value="">Pilih Lulusan</option>
                  <option value="1">Semua</option>
                  	{{ $now=date('Y') }}
                  		@for ($lulusan=2017; $lulusan <= $now ; $lulusan++)
                  			<option @if($lulusan==old('lulusan')) selected @endif value="{{ $lulusan }}">{{ $lulusan}}</option>
                  		@endfor
               	  </select>
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