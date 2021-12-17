@extends('layout.template')
@section('title', 'Edit Data Akun')
@section('content')
<div class="row">
<div class="col-md-6">
<div class="box box-primary">
    <div class="box-body box-profile">
    	@if(Auth::user()->level=="1" || Auth::user()->level=="2")
      <a href="/profile/{{ $profile->id }}" class="btn btn-flat btn-default">
				<span class="glyphicon glyphicon-arrow-left"></span> Kembali
			</a>
      @endif
            <form role="form" method="post" action="/profile/akun/{{ $profile->id }}">
              @method('patch')
              @csrf
              <div class="box-body">
                <div class="form-group @error('email') has-error @enderror">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" name="email" placeholder="Masukkan Email" 
                  value="{{ $profile->email }}">
                  @error('email')<i class="fa fa-fw fa-warning"></i>{{ $message }} @enderror
                </div>
                <div class="form-group @error('username') has-error @enderror">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" name="username" placeholder="Masukkan Username"
                  value="{{ $profile->username }}">
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
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
    </div>
</div>
</div>
</div>
@endsection