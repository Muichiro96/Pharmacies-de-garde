

@extends('shared.admin')
@section('title')
Modification Garde
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
Edit
@endsection
@section('content-header')
Modification Garde
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
<h4><i class="icon fa fa-check"></i>Succés  </h4>
{{ session()->get('success') }}
</div>
@endif
<div class="container">
    <div class="row">
        <div class="col mt-4">
        <div class="card">
            <div class="card-header bg-warning">
            <h3 class="card-title"><i class="fas fa-user-shield"></i>&nbsp; Modifier une Garde</h3>
            </div>
            
            
            <form method="post">
                @csrf
            <div class="card-body">
            <div class="form-group">
            <label for="type">Type :</label>
            <select class="form-control custom-select"  name="type">
                @if($garde->type=='Jour')<option selected>{{ $garde->type }}</option><option>Nuit</option><option>24h/24</option>@endif
                @if($garde->type=='Nuit')<option selected>{{ $garde->type }}</option><option >Jour</option><option>24h/24</option>@endif
                @if($garde->type=='24h/24')<option selected>{{ $garde->type }}</option><option >Jour</option><option>Nuit</option>@endif
                </select>
            </div>
            <div class="form-group">
            <label for="date">Date :</label>
            <div class="input-group date" id="date"  data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" name="date" value="{{ date_format(date_create(strval($garde->date)),'m/d/Y') }}" data-target="#date">
                <div class="input-group-append" data-target="#date" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
                </div>
            
            </div>
           
            <div class="form-group ">
                <label>Pharmacies :</label>
                <div class="select2-success">
                <select id="Myselect" class="form-control select2 select2-hidden-accessible" name="pharmacies[]" multiple="" data-placeholder="Selectionnez les pharmacies" data-dropdown-css-class="select2-success" style="width: 100%;" data-select2-id="15" tabindex="-1" aria-hidden="true">
                @foreach($garde->pharmacies as $pharmacie)
                <option selected>{{ $pharmacie->nom}}</option>
                @endforeach
                @foreach($pharmacies as $pharmacie)
                <option >{{ $pharmacie->nom}}</option>
                @endforeach
                </select>
                </div>
                </div>
                            
            
            
            <div class="card-footer">
            <button type="submit" class="btn btn-primary">Modifier</button>
            <a href="/garde/list" class="float-right">Liste gardes</a>
            </div>
            </form>
            </div>
    </div>
</div></div>
@endsection
@section('scripts')
@parent
<script src="/plugins/moment/moment.min.js"></script>
<script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<script src="/plugins/select2/js/select2.full.min.js"></script>

<script>
    $(function () {
        $("#Myselect").select2({
         
        });
        $('#date').datetimepicker({format: 'L'});
    })
</script>
@endsection