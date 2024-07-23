@extends('shared.admin')
@section('title')
Modification pharmacie
@endsection
@section('path1')
Pharmacie
@endsection
@section('path2')
Edit
@endsection
@section('content-header')
Modifier Pharmacie
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
            <div class="card-header bg-warning">
            <h3 class="card-title"><i class="fas fa-capsules"></i>&nbsp; Modifier la pharmacie</h3>
            </div>
            
            
            <form method="post">
                @csrf
            <div class="card-body">
            <div class="form-group">
            <label for="name">Nom Pharmacie :</label>
            <input type="text" name="name" class="form-control" value="{{ $pharmacie->nom }}" placeholder="Pharmcie Khouya..">
            </div>
            <div class="form-group">
            <label for="address">Adresse :</label>
            
            <input type="text" name="address" class="form-control" value="{{  $pharmacie->adresse}}" placeholder="Hay Ilham ,Dcheira..">
            </div>
            <div class="form-group">
                <label for="phone">Téléphone :</label>
                
                <input type="text" name="phone" class="form-control"  value="{{  $pharmacie->telephone}}" placeholder="+212687555">
                </div>
                <div class="form-group">
                <label for="district">Quartier :</label>
                
                <input type="text" name="district" class="form-control" value="{{ $pharmacie->quartier? $pharmacie->quartier : ''  }}"  placeholder="Hay Ilham">
                </div>
                <div class="form-group">
                    <label for="lattitude">Lattitude :</label>
                    
                    <input type="text" name="lattitude" class="form-control" value="{{ $pharmacie->lattitude }}" placeholder="1.455588">
                    </div>
                <div class="form-group">
                    
                    <label for="longitude">Longitude :</label>
                    
                    <input type="text" name="longitude" class="form-control" value="{{ $pharmacie->longitude }}" placeholder="25.1145">
                    </div>
                    
                        <div class="form-group">
                            <select class="form-control custom-select" name="city"  >
                                <option value="" disabled>Selectionnez la ville</option>
                                <option selected>{{ $pharmacie->ville->nom }}</option>
                                @foreach($villes as $ville)
                                <option >
                                   {{  $ville->nom }}
                                </option>
                                @endforeach
                               </select>
                            </div>
            
            
            <div class="card-footer">
            <button type="submit" class="btn btn-primary">Modifier</button>
            <a href="/pharmacie/list" class="float-right">Liste pharmacies</a>
            </div>
            </form>
            </div>
    </div>
</div></div>
@endsection