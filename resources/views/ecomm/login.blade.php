{{-- @extends('layout.auth')

@section('title')
    <title>Login | All Bike</title>
@endsection

@section('content')
<div class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a>Login  <b>AllBike</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
        <div class="card-body login-card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <p class="login-box-msg">Sign in to start your session</p>
            
            <form action="{{ route('pelanggan.postLogin') }}" method="post" id="contactForm" novalidate="novalidate">
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
@endsection --}}


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="robots" content="follow,index">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>All Bike | Customer Portal</title>
	<meta name="description" content="🔐 An Open Source Template for Login Page From Scratch Without Any CSS Framework">
    <meta name="keywords" content="login page css, login template, login css, login form template">
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
	<link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
	<link rel="stylesheet" href="{{ asset('css/additional.css') }}">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body>

	<div class="content">
		<div class="content-left">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form action="{{ route('pelanggan.postLogin') }}" method="POST">
                @csrf
                <div class="form-wrapper">
                    <div class="logo">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo">
                    </div>
                    <h1 class="text-title">Customer Portal</h1>
                    {{-- <div>Need an account? <a href="#register">Create an account</a></div> --}}
    
                    <div class="field-group">
                        <label class="label" for="txt-email">Email</label>
                        <input class="input" type="text" id="txt-email" name="email" />
                    </div>
                    <div class="field-group">
                        <div class="label-wrapper">
                            <label class="label" for="txt-password">Password</label>
                            <label class="label label--right" onclick="tooglePassword()">
                                <svg class="label-icon eye is--show" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                <svg class="label-icon eye-off is--hide" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-off"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                                <span class="label-text">Show</span>
                            </label>
                        </div>
                        <input class="input" type="password" id="txt-password" name="password" />
                    </div>
    
                    <div class="field-group">
                        <input class="btn-submit" type="submit" value="Log In" />
                    </div>
    
                    {{-- <div class="field-group">
                        <label class="checkbox-label">Keep me logged in
                            <input type="checkbox">
                            <span class="checkbox-checkmark"></span>
                        </label>
                    </div> --}}
    
                    {{-- <div class="field-group text-center">
                        <a href="#forgot-username">Forgot username?</a><span> · </span><a href="#forgot-password">Forgot password?</a>
                    </div> --}}
                </div>
            </form>
		</div>
		<div class="content-right">
			<div class="content-right-text">
				<h2>Login ke <i>Dashboard Customer</i> anda </h2>
                <span>Untuk melihat detil pembayaran, <i>track</i> belanjaan anda, serta dapatkan penawaran penawaran menarik lainnya</span>
            </div>
            <br>
			<a href="/" class="link-custom-domain">
				Kembali ke Home
			</a>
		</div>
	</div>


	<script>
		function a () {
			var p = document.querySelector('#txt-password');
			var t = document.querySelector('.label-text');
			var ey = document.querySelector('.eye');
			var eyo = document.querySelector('.eye-off');
			var currType = p.getAttribute('type');

			if (currType === 'password') {
				t.innerHTML = 'Hide';
				p.setAttribute('type', 'text');
				ey.classList.replace('is--show', 'is--hide');
				eyo.classList.replace('is--hide', 'is--show');
			} else {
				t.innerHTML = 'Show';
				p.setAttribute('type', 'password');
				eyo.classList.replace('is--show', 'is--hide');
				ey.classList.replace('is--hide', 'is--show');
			}
		}

		window.tooglePassword = a;
	</script>
</body>

</html>
