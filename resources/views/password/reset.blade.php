<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIA | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('template') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('template') }}/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('template') }}/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('template') }}/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('template') }}/dist/css/skins/_all-skins.min.css">
  <!-- Pace style -->
  <link rel="stylesheet" href="{{ asset('template') }}/plugins/pace/pace.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  
  <!-- /.login-logo -->
  <div class="login-box-body">
    <div class="text-center">
        <img src="{{ asset('template') }}/dist/img/smkti.png" style="width: 200px">
        <h4>Sistem Informasi Alumni <br>SMK TI Bali Global Karangasem</h4>
        <h3 class="login-box-msg">Reset Password</h3>
    </div>
    <form method="POST" action="{{ route('confirm') }}">
        @csrf

        <div class="form-group @error('email') has-error @enderror">
          <label for="email">Email</label>
          <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email" value="{{ old('email') }}">
          @error('email')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
        </div>
        <div class="form-group @error('username') has-error @enderror">
          <label for="email">Username</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" value="{{ old('username') }}">
          @error('username')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
        </div>
        <div class="form-group @error('password') has-error @enderror">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
          @error('password')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
        </div>
        <div class="form-group @error('password_confirmation') has-error @enderror">
          <label for="password">Konfirmasi Password</label>
          <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password">
          @error('password_confirmation')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
        </div>
        <div class="row">
            <div class="col-xs-5 pull-right">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
            </div>
        </div>
    </form>
    <p>Kembali ke halaman <a href="{{ route('login') }}">Login</a></p>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('template') }}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('template') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- PACE -->
<script src="{{ asset('template') }}/bower_components/PACE/pace.min.js"></script>
<!-- SlimScroll -->
<script src="{{ asset('template') }}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{ asset('template') }}/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('template') }}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('template') }}/dist/js/demo.js"></script>
<!-- page script -->
<script type="text/javascript">
  // To make Pace works on Ajax calls
  $(document).ajaxStart(function () {
    Pace.restart()
  })
  $('.ajax').click(function () {
    $.ajax({
      url: '#', success: function (result) {
        $('.ajax-content').html('<hr>Ajax Request Completed !')
      }
    })
  })
</script>
</body>
</html>
