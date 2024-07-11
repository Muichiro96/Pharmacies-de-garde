@extends('shared.admin')
@section('title')
Pharmacies
@endsection
@section('path1')
Pharmacie
@endsection
@section('path2')
List
@endsection
@section('content-header')
Pharmacy List
@endsection
@section('content')

<div class="container">
<div class="row">
<div class="col">
<a href="/pharmacie/add"><button class="btn btn-success mb-4"><i class="fas fa-plus"></i>Ajouter une pharmacie</button></a> 
</div></div>
@foreach($pharmacies as $pharmacie)
<div class="row">
    
<div class="col">
<div class="card">
    <div class="card-body">
<h3 class="text-success">
   <i class="fas fa-hospital"></i> {{$pharmacie->nom}}
</h3>

<i class="fas fa-building"></i> &emsp;<label>Adresse :</label>&emsp; {{$pharmacie->adresse}}
<br/>
<i class="fas fa-phone-alt"></i>&emsp;<label>Téléphone :</label>&emsp; {{$pharmacie->telephone}}
<br/>
<label><i class="fas fa-map-marker text-danger"></i> &emsp;Lattitude : </label> &emsp;{{$pharmacie->lattitude}} , &emsp;<label>Longitude :</label>&emsp; {{$pharmacie->longitude }}
<br/><div class="float-right"><label>Ville :</label>&emsp; {{$pharmacie->ville->nom}}</div>
</div>
<div class="card-footer">
<a href="/pharmacie/delete/{{$pharmacie->idPharmacie}}"><button  class="btn btn-danger float-right"><i class="fas fa-trash"></i></button></a>
<a href="/pharmacie/edit/{{$pharmacie->idPharmacie}}"><button  class="btn btn-warning float-right mr-4"><i class="fas fa-pen"></i></button></a>

</div>
</div>
</div></div>
@endforeach
</div>
@endsection