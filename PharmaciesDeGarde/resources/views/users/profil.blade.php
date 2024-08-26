@extends('shared.layout')
@section('title')
Profil
@endsection

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="/avatar.png" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{ $user->name }}</h3>
                
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Username :</b> <a class="float-right">{{ $user->name}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Email :</b> <a class="float-right">{{ $user->email }}</a>
                            </li>
                            
                <li class="list-group-item">
                <b>Suggestions</b> <a class="float-right">{{ $user->suggestions->count() }}</a>
                </li>
                
                </ul>
                
                </div>
                
                </div>
        </div>
      
    </div>
</div>
@endsection
