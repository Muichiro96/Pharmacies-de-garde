<html><head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>TecForge | Registration Page</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

<link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">

<link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

<link rel="stylesheet" href="/dist/css/adminlte.min.css?v=3.2.0">
</head>

<body class="register-page" style="min-height: 570.781px;">

@if($errors->any())
<div class="alert alert-warning alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

<ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
</ul>
</div> 

@endif

<div class="register-box">
<div class="register-logo">
<a href="#"><b>Tec</b>Forge</a>
</div>
<div class="card">
<div class="card-body register-card-body">
<p class="login-box-msg">Register a new membership</p>
<form action="/register" method="post">
@csrf
<div class="input-group mb-3">
<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Full name">
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-user"></span>
</div>
</div>
</div>
<div class="input-group mb-3">
<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email">
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-envelope"></span>
</div>
</div>
</div>
<div class="input-group mb-3">
<input type="password" name="password" class="form-control @error('password') is-invalid  @enderror" placeholder="Password">
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-lock"></span>
</div>
</div>
</div>
<div class="input-group mb-3">
<input type="password" name="password_confirmation" class="form-control @error('password') is-invalid  @enderror" placeholder="Retype password">
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-lock"></span>
</div>
</div>
</div>
<div class="row">
<div class="col-8">
<div class="icheck-primary">
<input type="checkbox" id="agreeTerms" name="terms" value="agree">
<label for="agreeTerms">
I agree to the <a href="#">terms</a>
</label>
</div>
</div>

<div class="col-4">
<button type="submit" class="btn btn-primary btn-block">Register</button>
</div>

</div>
</form>

<a href="{{route('login')}}" class="text-center">I already have a membership</a>
</div>

</div>
</div>


<script src="/plugins/jquery/jquery.min.js"></script>

<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="/dist/js/adminlte.min.js?v=3.2.0"></script>
<br/>


</body></html>