@extends('shared.layout')
@section('title')
Suggestions
@endsection
@section('content')
<div class="content-wrapper" style="height:auto;">

    <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
    <h1 style="margin-left:90px;">- Mes suggestions</h1>
    </div>
    <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="/home">Home</a></li>
    <li class="breadcrumb-item active">Suggestions</li>
    
    </ol>
    </div>
    </div>
    </div>
    </section>
    
    <section class="content">
    
        <div class="container">

            @foreach($list as $suggestion)
            <div class="row">
            <div class="col">
            <div class="card">
                
                <div class="card-body">
                    <div class="float-right">{{$suggestion->created_at}} </div>
            <h5 class="text-primary">
               <i class="fas fa-comment"></i>&nbsp;Suggestion &#8470; {{ $list->count()-($list->lastItem()+$loop->index +1) }}</h5>
            
            
            <label>Status :</label>&emsp; 
             @if($suggestion->status=="Approved") 
             <span class="text-success text-bold">Approved</span>
            
            @elseif($suggestion->status=="Disapproved")
            <span class="text-danger text-bold">Dispproved</span>
            
            @else
            <span class="text-warning text-bold">Pending</span>
            @endif
            <br/>
            <div class="hidden" id="collapsed{{ $suggestion->idSuggestion }}" style="display: none">
                <h4 class="text-success">{{ $suggestion->nom }}</h4>
                <i class="fas fa-building"></i><label>&nbsp;Adresse :</label>&nbsp;<span>{{ $suggestion->adresse }}</span>
                <br/>
<i class="fas fa-phone-alt"></i>&emsp;<label>Téléphone :</label>&emsp; {{$suggestion->telephone}}
<br/>
<label><i class="fas fa-map-marker text-danger"></i> &emsp;Lattitude : </label> &emsp;{{$suggestion->lattitude}} ,&emsp;<label>Longitude :</label>&emsp; {{$suggestion->longitude }}
<br/><i class="fas fa-city"></i>&nbsp;<label>Ville :</label>&emsp; {{$suggestion->nom_ville}}
            </div>
            <button class="float-right btn btn-link expd" value="{{ $suggestion->idSuggestion }}" onclick="show(this)">Voir plus ...</button>
            <br/>
            </div>
            </div>
            </div></div>
            @endforeach
        </div>
        @if($list->hasPages())
<div class="mt-3">
    {{ $list->links('pagination::bootstrap-5') }}
</div>
@endif
    </section>
    
    </div>
    
    
<script>
    function show(element){
        let collapsed =document.getElementById(`collapsed${element.value}`);
        if (collapsed.style.display === "none") {
    collapsed.style.display = "";
    element.innerHTML="...Voir moins";
  } else {
    element.innerHTML="Voir plus ..";
    collapsed.style.display = "none";
  }
        
    }
</script>

@endsection