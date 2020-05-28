@extends('layout.auth')

@section('title')
    <title>Login | All Bike</title>
@endsection

@section('content')
<div class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a>Login<b>AllBike</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
        <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="{{ route('pelanggan.login') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input  class="form-control" 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="Email Address" 
                        value="{{ old('email') }}" 
                        autofocus 
                        required
                >
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input  class="form-control" 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="******"
                        required 
                >
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                @if (session('error'))
                <div class="col-md-12">
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                </div>
                @endif
                <div class="col-6">
                    <button class="btn btn-primary px-4">Login</button>
                </div>
                <div class="col-6 text-right">
                    <button class="btn btn-link px-0" type="button">Forgot password?</button>
                </div>
            </div>
        </form>
        </div>
    </div>
    </div>
</div>
@endsection