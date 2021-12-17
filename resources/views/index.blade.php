@extends('layout.template')
@section('title', 'Dashboard')
@section('content')

@if(Auth::user()->level=="0")
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
	<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3>{{$alumni}}</h3>

        <p>Data Alumni</p>
      </div>
      <div class="icon">
        <i class="fa fa-user"></i>
      </div>
      <a href="{{ url('/alumni') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3>{{$perusahaan}}</h3>

        <p>Data Perusahaan</p>
      </div>
      <div class="icon">
        <i class="fa fa-suitcase"></i>
      </div>
      <a href="{{url('/perusahaan')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>{{ $lowongan }}</h3>

        <p>Data Lowongan</p>
      </div>
      <div class="icon">
        <i class="fa fa-archive"></i>
      </div>
      <a href="{{ url('/lowongan') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">
        <h3>{{ $kategori }}</h3>

        <p>Kategori Lowongan</p>
      </div>
      <div class="icon">
        <i class="fa fa-check-circle-o"></i>
      </div>
      <a href="{{ url('/kategori')}}" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
</div>
@endif

@if(Auth::user()->level=="1")
<div class="row">
  <div class="col-md-5">
    <!-- Box Comment -->
    <div class="box box-widget">
      <div class="box-header with-border">
        <i class="fa fa-bullhorn"></i>

        <h3 class="box-title">Selamat Datang di <b>S</b>.<b>I</b>.<b>A</b></h3>
      </div>
      <!-- /.box-header -->
      <form method="post" action="/upload/{{ Auth::user()->alumni->id }}">
        @csrf
      <div class="box-body">
        @if(session('success'))
          <div class="alert alert-success alert-dismissible" style="margin-top: 10px">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="fa fa-check"></i> Alert!</h4>
              {{ session('success') }}
          </div>
        @endif
        <div class="callout callout-info">
        <h4>Status dan pesan beserta kesan.</h4>

          <p>Silakan upload status anda setelah lulus sekolah dan berikan kesan beserta pesan anda selama sekolah di SMK TI Bali Global Karangasem.</p>
        </div>
        <div class="form-group">
          <label for="status">Status (Kuliah / Kerja)</label>
          <input type="text" class="form-control" name="status" id="status" placeholder="Keterangan">
        </div>
        <div class="form-group">
          <label for="pesan">Pesan dan Kesan</label>
          <textarea id="editor1" name="pesan" rows="10" cols="80">-</textarea>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      <!-- /.box-footer -->
    </div>
  </form>
    <!-- /.box -->
  </div>

  <div class="col-md-4">
  <!-- Widget: user widget style 1 -->
  <div class="box box-widget widget-user-2">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-yellow">
      <div class="widget-user-image">
        <img class="img-circle" src="{{ asset('template') }}/dist/img/kepala_sekolah.png" alt="User Avatar">
      </div>
      <!-- /.widget-user-image -->
      <h4 style="font-size: 19px;" class="widget-user-username">I Nyoman Suarjana, S.Sos</h4>
      <h5 class="widget-user-desc">Kepala Sekolah</h5>
    </div>
    <div class="box-footer no-padding">
      <ul class="nav nav-stacked">
        <li><a>Status <span class="pull-right badge bg-blue">Swasta</span></a></li>
        <li><a>Akreditasi <span class="pull-right badge bg-aqua">B</span></a></li>
        <li><a>Kurikulum <span class="pull-right badge bg-green">2013</span></a></li>
        <li><a href="https://web.facebook.com/smktibaliglobalkarangasem/">Facebook <span class="pull-right badge bg-red">Smktibg karangasem</span></a></li>
      </ul>
    </div>
  </div>
  </div>

  <div class="col-md-3">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3>{{$alumni}}</h3>

        <p>Daftar Alumni</p>
      </div>
      <div class="icon">
        <i class="fa fa-user"></i>
      </div>
      <a href="{{ url('/alumni/data') }}" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>

    <div class="small-box bg-green">
      <div class="inner">
        <h3>{{$perusahaan}}</h3>

        <p>Data Perusahaan</p>
      </div>
      <div class="icon">
        <i class="fa fa-suitcase"></i>
      </div>
      <a href="{{url('/perusahaan')}}" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>

    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>{{ $lowongan }}</h3>

        <p>Data Lowongan</p>
      </div>
      <div class="icon">
        <i class="fa fa-archive"></i>
      </div>
      <a href="{{ url('/lowongan') }}" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  </div>
  
@endif
@if(Auth::user()->level=="2")
<div class="row">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3>{{$lowongan}}</h3>

        <p>Data Lowongan</p>
      </div>
      <div class="icon">
        <i class="fa fa-suitcase"></i>
      </div>
      <a href="/lihatlowongan/{{Auth::user()->perusahaan->id}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>{{ $lamaran }}</h3>

        <p>Data Lamaran</p>
      </div>
      <div class="icon">
        <i class="fa fa-archive"></i>
      </div>
      <a href="{{ url('/lamaran') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-md-5">
  <!-- Widget: user widget style 1 -->
  <div class="box box-widget widget-user-2">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-yellow">
      <div class="widget-user-image">
        <img class="img-circle" src="{{ asset('template') }}/dist/img/kepala_sekolah.png" alt="User Avatar">
      </div>
      <!-- /.widget-user-image -->
      <h4 class="widget-user-username">I Nyoman Suarjana, S.Sos</h4>
      <h5 class="widget-user-desc">Kepala Sekolah</h5>
    </div>
    <div class="box-footer no-padding">
      <ul class="nav nav-stacked">
        <li><a>Status <span class="pull-right badge bg-blue">Swasta</span></a></li>
        <li><a>Akreditasi <span class="pull-right badge bg-aqua">B</span></a></li>
        <li><a>Kurikulum <span class="pull-right badge bg-green">2013</span></a></li>
        <li><a href="https://web.facebook.com/smktibaliglobalkarangasem/">Facebook <span class="pull-right badge bg-red">Smktibg karangasem</span></a></li>
      </ul>
    </div>
  </div>
  <!-- /.widget-user -->
</div>
</div>
@endif
@endsection