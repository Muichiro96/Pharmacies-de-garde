<html lang="en"><head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Log in</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

<link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">

<link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

<link rel="stylesheet" href="/dist/css/adminlte.min.css?v=3.2.0">
<script defer="" referrerpolicy="origin" src="/cdn-cgi/zaraz/s.js?z=JTdCJTIyZXhlY3V0ZWQlMjIlM0ElNUIlNUQlMkMlMjJ0JTIyJTNBJTIyQWRtaW5MVEUlMjAzJTIwJTdDJTIwTG9nJTIwaW4lMjIlMkMlMjJ4JTIyJTNBMC4zODU1NjEyMTkxNzM0MjE0NSUyQyUyMnclMjIlM0ExMzY2JTJDJTIyaCUyMiUzQTc2OCUyQyUyMmolMjIlM0E2NDElMkMlMjJlJTIyJTNBMTM2NiUyQyUyMmwlMjIlM0ElMjJodHRwcyUzQSUyRiUyRmFkbWlubHRlLmlvJTJGdGhlbWVzJTJGdjMlMkZwYWdlcyUyRmV4YW1wbGVzJTJGbG9naW4uaHRtbCUyMiUyQyUyMnIlMjIlM0ElMjJodHRwcyUzQSUyRiUyRmFkbWlubHRlLmlvJTJGdGhlbWVzJTJGdjMlMkZwYWdlcyUyRnRhYmxlcyUyRnNpbXBsZS5odG1sJTIyJTJDJTIyayUyMiUzQTI0JTJDJTIybiUyMiUzQSUyMlVURi04JTIyJTJDJTIybyUyMiUzQS02MCUyQyUyMnElMjIlM0ElNUIlNUQlN0Q="></script><script nonce="0cbf6607-29c3-4c2f-a064-c77a515d4a70">try{(function(w,d){!function(U,V,W,X){U[W]=U[W]||{};U[W].executed=[];U.zaraz={deferred:[],listeners:[]};U.zaraz._v="5705";U.zaraz.q=[];U.zaraz._f=function(Y){return async function(){var Z=Array.prototype.slice.call(arguments);U.zaraz.q.push({m:Y,a:Z})}};for(const $ of["track","set","debug"])U.zaraz[$]=U.zaraz._f($);U.zaraz.init=()=>{var ba=V.getElementsByTagName(X)[0],bb=V.createElement(X),bc=V.getElementsByTagName("title")[0];bc&&(U[W].t=V.getElementsByTagName("title")[0].text);U[W].x=Math.random();U[W].w=U.screen.width;U[W].h=U.screen.height;U[W].j=U.innerHeight;U[W].e=U.innerWidth;U[W].l=U.location.href;U[W].r=V.referrer;U[W].k=U.screen.colorDepth;U[W].n=V.characterSet;U[W].o=(new Date).getTimezoneOffset();if(U.dataLayer)for(const bg of Object.entries(Object.entries(dataLayer).reduce(((bh,bi)=>({...bh[1],...bi[1]})),{})))zaraz.set(bg[0],bg[1],{scope:"page"});U[W].q=[];for(;U.zaraz.q.length;){const bj=U.zaraz.q.shift();U[W].q.push(bj)}bb.defer=!0;for(const bk of[localStorage,sessionStorage])Object.keys(bk||{}).filter((bm=>bm.startsWith("_zaraz_"))).forEach((bl=>{try{U[W]["z_"+bl.slice(7)]=JSON.parse(bk.getItem(bl))}catch{U[W]["z_"+bl.slice(7)]=bk.getItem(bl)}}));bb.referrerPolicy="origin";bb.src="/cdn-cgi/zaraz/s.js?z="+btoa(encodeURIComponent(JSON.stringify(U[W])));ba.parentNode.insertBefore(bb,ba)};["complete","interactive"].includes(V.readyState)?zaraz.init():U.addEventListener("DOMContentLoaded",zaraz.init)}(w,d,"zarazData","script");})(window,document)}catch(e){throw fetch("/cdn-cgi/zaraz/t"),e;};</script></head>
<body class="login-page" style="min-height: 496.781px;">
@if($errors->any())
<div class="alert alert-danger alert-dismissible" width="100%">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>


        @foreach($errors->all() as $error)
        Login Failed !  {{$error}}
        @endforeach

</div> 

@endif
@if(session()->has('message'))
<div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h4><i class="icon fa fa-check"></i> Success!</h4>
{{ session()->get('message') }}.Please Log In !
</div>
@endif
<div class="login-box">
<div class="login-logo">
<a href="#"><b>Tec</b>Forge</a>
</div>

<div class="card">
<div class="card-body login-card-body">
<p class="login-box-msg">Sign in to start your session</p>
<form action="" method="post">
@csrf
<div class="input-group mb-3">
<input type="email" name="email" class="form-control" placeholder="Email">
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-envelope"></span>
</div>
</div>
</div>
<div class="input-group mb-3">
<input type="password" name="password" class="form-control" placeholder="Password">
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-lock"></span>
</div>
</div>
</div>
<div class="row">
<div class="col-8">
<div class="icheck-primary">
<input type="checkbox" id="remember" name="remember_me">
<label for="remember">
Remember Me
</label>
</div>
</div>

<div class="col-4">
<button type="submit" class="btn btn-primary btn-block">Sign In</button>
</div>

</div>
</form>


<p class="mb-1">
<a href="#">I forgot my password</a>
</p>
<p class="mb-0">
<a href="{{route('register')}}" class="text-center">Register a new membership</a>
</p>
</div>

</div>
</div>


<script src="/plugins/jquery/jquery.min.js"></script>

<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="/dist/js/adminlte.min.js?v=3.2.0"></script>


</body></html>