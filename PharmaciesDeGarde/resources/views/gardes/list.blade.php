@extends('shared.admin')
@section('title')
Gardes
@endsection
@section('imports')
@parent
<link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="/plugins/select2/css/select2.min.css">

<link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
@endsection
@section('path1')
Duty
@endsection
@section('path2')
List
@endsection
@section('content-header')
Liste des gardes
@endsection
@section('content')

<div class="container">
<div class="row">
<div class="col">
<a href="/garde/add"><button class="btn btn-success mb-4"><i class="fas fa-plus"></i>Ajouter une garde</button></a> 
</div></div>
@foreach($gardes as $garde)
<div class="row">
    
<div class="col">
<div class="card">
    <div class="card-body">
<h3 class="text-danger">
   <i class="fas fa-shield-alt"></i> Garde
</h3>

<label><i class="fas fa-list"></i> &emsp;Type :</label>&emsp; 
 @if($garde->type=="Jour") 
 {{$garde->type}} 
<i class='fas fa-sun text-warning'></i>
@elseif($garde->type=='Nuit')
{{$garde->type}} 
<i class='fas fa-moon'></i>
@else
<span class="right badge badge-success">24h/24</span>
@endif
<br/>

<label><i class="fas fa-calendar-day"></i> &emsp;Date : </label> &emsp;{{$garde->date}} 
<br/><i class="fas fa-hospital"></i>&emsp;<label>Pharmacies :</label>&emsp;   <div class="select2-success" style="display:inline;">
                <select id="Myselect" class="form-control select2 select2-hidden-accessible" name="pharmacies[]" multiple=""  data-dropdown-css-class="select2-success" style="width: 100%;" data-select2-id="15" tabindex="-1" aria-hidden="true" disabled>
                @foreach($garde->pharmacies as $pharmacie)
                <option selected>{{ $pharmacie->nom}}</option>
                @endforeach
                </select>
                </div>
<br/>
</div>
<div class="card-footer">
<a href="/garde/delete/{{$garde->idGarde}}"><button  class="btn btn-danger float-right"><i class="fas fa-trash"></i></button></a>
<a href="/garde/edit/{{$garde->idGarde}}"><button  class="btn btn-warning float-right mr-4"><i class="fas fa-pen"></i></button></a>

</div>
</div>
</div></div>
@endforeach
</div>
@endsection
@section('scripts')
@parent
<script src="/plugins/moment/moment.min.js"></script>
<script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<script src="/plugins/select2/js/select2.full.min.js"></script>

<script>
    $(function () {
        $("#Myselect").select2();
        $('#date').datetimepicker({format:'L'});
    })
</script>
@endsection