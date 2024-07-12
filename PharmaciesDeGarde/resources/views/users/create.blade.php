@extends('shared.admin')
@section('title')
Ajout utilisateur
@endsection
@section('path1')
User
@endsection
@section('path2')
Add
@endsection
@section('content-header')
Ajouter un utilisateur
@endsection
@section('content')
@if($errors->any())
<div class="alert alert-warning alert-dismissible mt-4 ml-4 mr-4">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

<ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
</ul>
</div> 

@endif

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible mt-4 ml-4 mr-4">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h4><i class="icon fa fa-check"></i>Succés </h4>
{{ session()->get('success') }}
</div>
@endif
<div class="container">
    <div class="row">
        <div class="col mt-4">
        <div class="card">
            <div class="card-header bg-primary">
            <h3 class="card-title"><i class="fa fa-user-md"></i>&nbsp; Ajouter un utilisateur</h3>
            </div>
            
            
            <form method="post">
                @csrf
            <div class="card-body">
            <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Full name">
            </div>
            <div class="form-group">
            <label for="email">E-mail :</label>
            
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="example@mail.com">            </div>
            <div class="form-group">
                <label for="password">Mot de Passe :</label>
                
                <input type="password" name="password" class="form-control @error('password') is-invalid  @enderror" placeholder="P@ssword">
                </div>
                <div class="form-group">
                <label for="password_confirmation">Confirmer le mot de passe :</label>
                
                <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid  @enderror" placeholder="Retype password">
                </div>
                <div class="form-group">
                    
                        <div class="icheck-success">
                        <input type="checkbox" id="isAdmin" name="isAdmin">
                        <label for="isAdmin">
                          Admin
                        </label>
                        
                </div>
            
            <div class="card-footer">
            <button type="submit" class="btn btn-primary">Creer</button>
            <a href="/user/list" class="float-right">Liste utilisateurs</a>
            </div>
            </form>
            </div>
    </div>
</div></div>
@endsection