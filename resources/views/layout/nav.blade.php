<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    @if(Auth::user()->level=="0")
    <li>
        <a href="{{ url('/index') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
    </li>
    <li><a href="{{ url('/alumni') }}"><i class="fa fa-user"></i> <span>Data Alumni</span></a></li>
    <li><a href="{{url('/perusahaan')}}"><i class="fa fa-suitcase"></i> <span>Data Perusahaan</span></a></li>
    <li><a href="{{url('/kategori')}}"><i class="fa  fa-check-circle-o"></i> <span>Data Kategori Lowongan</span></a></li>
    <li><a href="{{ url('/lowongan') }}"><i class="fa fa-archive"></i> <span>Data Lowongan Pekerjaan</span></a></li>
    <li><a href="/lamaran"><i class="fa fa-file-archive-o"></i> <span>Data Lamaran Pekerjaan</span></a></li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-print"></i> <span>Cetak Laporan</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="/laporan/alumni"><i class="fa fa-circle-o"></i> Laporan Data Alumni</a></li>
        <li><a href="/laporan/perusahaan"><i class="fa fa-circle-o"></i> Laporan Data Perusahaan</a></li>
        <li><a href="/laporan/lowongan"><i class="fa fa-circle-o"></i> Laporan Data Lowongan</a></li>
        <li><a href="/laporan/lamaran"><i class="fa fa-circle-o"></i> Laporan Data Lamaran</a></li>
      </ul>
    </li>
    @endif
    @if(Auth::user()->level=="1")
    <li><a href="{{ url('/index') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
    <li><a href="/alumni/data"><i class="fa fa-user"></i> <span>Alumni</span></a></li>
    <li><a href="{{url('/perusahaan')}}"><i class="fa fa-industry"></i> <span>Perusahaan</span></a></li>
    <li><a href="/lowongan"><i class="fa fa-suitcase"></i> <span>Lowongan Pekerjaan</span></a></li>
    @endif
    @if(Auth::user()->level=="2")
    <li><a href="{{ url('/index') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
    <li><a href="/lihatlowongan/{{Auth::user()->perusahaan->id}}"><i class="fa  fa-file-archive-o"></i> <span>Lihat Lowongan Pekerjaan</span></a></li>
    <li><a href="/tambahlowongan"><i class="fa fa-plus-square-o"></i> <span>Buat Lowongan Pekerjaan</span></a></li>
    <li><a href="/lamaran"><i class="fa fa-archive"></i> <span>Lihat Lamaran Pekerjaan</span></a></li>
    @endif
</ul>