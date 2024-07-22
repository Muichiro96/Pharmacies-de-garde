@extends('shared.admin')
@section('title')
Suggestions
@endsection
@section('path1')
Suggestion
@endsection
@section('path2')
List
@endsection
@section('content-header')
Suggestion List
@endsection
@section('content')
<table class="table table-striped">
<thead class="table-dark">
    <tr>
        <th>&#8470;</th>
        <th>Auteur</th>
        <th>Status</th>
        <th>Pharmacie</th>
        <th></th>
    </tr>
</thead>

@foreach($suggestions as $suggestion)
<tr>
    <td>{{  $loop->index + 1}}</td>
    <td>{{ $suggestion->user->name }}</td>
    <td class="status{{ $suggestion->idSuggestion }}"><span class="badge bg-warning" >{{  $suggestion->status }}</span></td>
    <td>{{ $suggestion->nom }}</td>
    <td class="actions{{ $suggestion->idSuggestion }}">
        <button class="btn btn-primary view" value="{{ $suggestion->idSuggestion }}"><i class="fas fa-eye"></i></button>
        <button class="btn btn-success approve" value="{{ $suggestion->idSuggestion }}"><i class="fas fa-check"></i></button>
        <button class="btn btn-danger"><i class="fa fa-times"></i></button>
        
        
    </td>
</tr>

@endforeach

@foreach($suggestions as $suggestion)
<div class="modal modal{{ $suggestion->idSuggestion }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            
            
            <div class="modal-body">
                <div class="card-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <br/>
                <div class="form-group">
                <label for="name">Nom Pharmacie :</label>
                <input type="text" name="name" class="form-control"  value="{{ $suggestion->nom }}" disabled>
                </div>
                <div class="form-group">
                <label for="address">Adresse :</label>
                
                <input type="text" name="address" class="form-control"  value="{{ $suggestion->adresse }}" disabled>
                </div>
                <div class="form-group">
                    <label for="phone">Téléphone :</label>
                    
                    <input type="text" name="phone" class="form-control"  value="{{ $suggestion->telephone }}" disabled>
                    </div>
                    <div class="form-group">
                    <label for="district">Quartier</label>(optionnel)<label>:</label>
                    
                    <input type="text" name="district" class="form-control"  value="{{ $suggestion->quartier }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="lattitude">Lattitude :</label>
                        
                        <input type="text" name="lattitude" class="form-control"  value="{{ $suggestion->lattitude }}" disabled>
                        </div>
                    <div class="form-group">
                        
                        <label for="longitude">Longitude :</label>
                        
                        <input type="text" name="longitude" class="form-control" value="{{ $suggestion->longitude }}" disabled>
                        </div>
                     
                            <div class="form-group">
                                <label for="ville">Ville :</label>
                                <input type="text" name="ville" class="form-control"  value="{{ $suggestion->nom_ville }}" disabled>
                                </div>
                
                
               
                
            
                
                
            
            </div>
           
          
          </div>
        </div>
      </div>
</div>
@endforeach


@endsection
@section('scripts')
@parent
<script>
    let arr=document.getElementsByClassName('view');
    
    for(let i=0;i<arr.length;i++){
        arr[i].addEventListener('click',function(){
            $(`.modal${arr[i].value}`).modal("toggle");
            
        });
    }
let approveBtns=document.getElementsByClassName('approve');
for(let i=0;i<approveBtns.length;i++){
    approveBtns[i].addEventListener('click',function(){
        console.log(approveBtns[i].value);
        $.ajax({
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}" },
            type: "POST",
            url: "{{route('approve')}}",
            contentType: "application/json",
            dataType: "json",
            data: JSON.stringify({suggestion : approveBtns[i].value }),
            success: function(data){
                let id=approveBtns[i].value
                if(data.success){
               $(`.actions${id}`).html("");
               $(`.status${id}`).html('<span class="badge bg-success" >Approved</span>');
                }
            }

        });
    })
}
</script>
@endsection