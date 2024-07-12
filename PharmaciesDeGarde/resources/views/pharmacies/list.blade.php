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
<div class="col-4">
<a href="/pharmacie/add"><button class="btn btn-success mb-4"><i class="fas fa-plus"></i>Ajouter une pharmacie</button></a> 

</div>
<div class="col"></div>
<div class="col"></div>
<div class="col"></div>
<div class="col-4" >
   
<select class="form-control"  id="city" >
                                <option value="" disabled selected>Filtrer par ville</option>
                                @foreach($villes as $ville)
                                <option value="{{$ville->idVille}}">
                                   {{  $ville->nom }}
                                </option>
                                @endforeach
                                </select>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 
                                                     
</div>
<div class="col">
    <button class="btn btn-primary" onclick="filter()">Filtrer</button>      
</div>
</div>
<div class="filtered">
    <div class="row">
@foreach($pharmacies as $pharmacie)

    
<div class="col col-md-4">
<div class="card" style="height: 310px">
    <div class="card-body">
<h3 class="text-success">
   <i class="fas fa-hospital"></i> {{$pharmacie->nom}}
</h3>

<i class="fas fa-building"></i> &emsp;<label>Adresse :</label>&emsp; {{$pharmacie->adresse}}
<br/>
<i class="fas fa-phone-alt"></i>&emsp;<label>Téléphone :</label>&emsp; {{$pharmacie->telephone}}
<br/>
<label><i class="fas fa-map-marker text-danger"></i> &emsp;Lattitude : </label> &emsp;{{$pharmacie->lattitude}} <br/> &emsp;&emsp;<label>Longitude :</label>&emsp; {{$pharmacie->longitude }}
<br/><div class="float-right"><label>Ville :</label>&emsp; {{$pharmacie->ville->nom}}</div>
</div>
<div class="card-footer" style="height: 45px;">
<a href="/pharmacie/delete/{{$pharmacie->idPharmacie}}"><button  class="btn btn-danger float-right"><i class="fas fa-trash"></i></button></a>
<a href="/pharmacie/edit/{{$pharmacie->idPharmacie}}"><button  class="btn btn-warning float-right mr-4"><i class="fas fa-pen"></i></button></a>

</div>
</div>
</div>
@endforeach
</div>
@if($pharmacies->hasPages())
<div class="mt-3">
    {{ $pharmacies->links('pagination::bootstrap-5') }}
</div>
@endif
</div>

@endsection
@section('scripts')
@parent
<script>
     $('body').Layout('fixLayoutHeight')
function filter(){
   
    if($('#city').val()){
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
            type: "POST",
            url: "{{route('filterCity')}}",
            contentType: "application/json",
            dataType: "json",
            data: JSON.stringify({id : $('#city').val() }),
            success: function(data){
               $(".filtered").html(`${data.request}`);
            }

        });
    }else {
        alert("Selectionnez d'abord la ville");
    }
    
   
}
</script>
@endsection