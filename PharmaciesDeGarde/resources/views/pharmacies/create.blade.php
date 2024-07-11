@extends('shared.admin')
@section('title')
Ajout Pharmacie
@endsection
@section('path1')
Pharmacie
@endsection
@section('path2')
Add
@endsection
@section('content-header')
Ajouter Pharmacie
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
            <div class="card-header bg-success">
            <h3 class="card-title"><i class="fas fa-capsules"></i>&nbsp; Ajouter une pharmacie</h3>
            </div>
            
            
            <form method="post">
                @csrf
            <div class="card-body">
            <div class="form-group">
            <label for="name">Nom Pharmacie :</label>
            <input type="text" name="name" class="form-control"  placeholder="Pharmcie Khouya..">
            </div>
            <div class="form-group">
            <label for="address">Adresse :</label>
            
            <input type="text" name="address" class="form-control"  placeholder="Hay Ilham ,Dcheira..">
            </div>
            <div class="form-group">
                <label for="phone">Téléphone :</label>
                
                <input type="text" name="phone" class="form-control"  placeholder="+212687555">
                </div>
                <div class="form-group">
                <label for="district">Quartier :</label>
                
                <input type="text" name="district" class="form-control"  placeholder="Hay Ilham">
                </div>
                <div class="form-group">
                    
                    <label for="longitude">Longitude :</label>
                    
                    <input type="text" name="longitude" class="form-control"  placeholder="25.1145">
                    </div>
                    <div class="form-group">
                        <label for="lattitude">Lattitude :</label>
                        
                        <input type="text" name="lattitude" class="form-control"  placeholder="1.455588">
                        </div>
                        <div class="form-group">
                            <label for="ville">Ville :</label>
                            <select class="form-control custom-select" name="city"  >
                                <option value="" disabled selected>Selectionnez la ville</option>
                                @foreach($villes as $ville)
                                <option >
                                   {{  $ville->nom }}
                                </option>
                                @endforeach
                                </select>
                            </div>
            
            
            <div class="card-footer">
            <button type="submit" class="btn btn-primary">Creer</button>
            <button type="submit" class="btn btn-default float-right">Liste pharmacies</button>
            </div>
            </form>
            </div>
    </div>
</div></div>
@endsection