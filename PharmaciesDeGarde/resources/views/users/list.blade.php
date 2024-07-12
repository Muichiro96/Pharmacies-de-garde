@extends('shared.admin')
@section('title')
Users
@endsection

@section('path1')
User
@endsection
@section('path2')
List
@endsection
@section('content-header')
Liste des utilisateurs
@endsection
@section('content')

<div class="container">
<div class="row">
<div class="col">
<a href="/user/add"><button class="btn btn-success mb-4"><i class="fas fa-plus"></i>Ajouter une utilisateur</button></a> 
</div></div>

<div class="row">
    
<div class="col">
<div class="card">
<div class="card-body p-0">
<table class="table table-striped">
<thead>
   
<tr>
<th style="width: 10px">#</th>
<th>Name</th>
<th>E-mail</th>
<th style="width: 40px">isAdmin</th>
<th></th>
</tr>
</thead>
<tbody>
@foreach($users as $user)
<tr>
<td>{{ $loop->index +1 }}</td>
<td>{{$user->name}}</td>
<td>
{{$user->email}}
</td>
<td>@if($user->isAdmin) 
    Oui &nbsp;<i class='fas fa-user-tie'></i> 
    @else
    Non&nbsp;<i class="fas fa-user"></i></td>
    @endif
<td><a href="/user/delete/{{$user->id}}"><button  class="btn btn-danger"><i class="fas fa-trash"></i></button></a>
<a href="/user/edit/{{$user->id}}"><button  class="btn btn-warning"><i class="fas fa-pen"></i></button></a>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>


</div>
</div></div>
@if($users->hasPages())
<div class="mt-3">
    {{ $users->links('pagination::bootstrap-5') }}
    </div>
@endif
</div>
@endsection
