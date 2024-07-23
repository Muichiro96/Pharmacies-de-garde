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
@if(!$suggestions->isEmpty())
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
    <td id="status{{ $suggestion->idSuggestion }}"><span class="text-warning" >{{  $suggestion->status }}</span></td>
    <td>{{ $suggestion->nom }}</td>
    <td >
        <button class="btn btn-primary view actions{{ $suggestion->idSuggestion }}" value="{{ $suggestion->idSuggestion }}"><i class="fas fa-eye"></i></button>
        <button class="btn btn-success approve actions{{ $suggestion->idSuggestion }}" value="{{ $suggestion->idSuggestion }}" name="approve"><i class="fas fa-check"></i></button>
        <button class="btn btn-danger disapprove actions{{ $suggestion->idSuggestion }}" name="disapprove" value="{{ $suggestion->idSuggestion }}"><i class="fa fa-times"></i></button>
        
        
    </td>
</tr>

@endforeach
</table>

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
@else
<br/>

<center><i class="fas fa-exclamation-triangle text-warning"></i> &nbsp;

    Pas de suggestions disponibles pour le moment !</center>
@endif

@if($suggestions->hasPages())
<div class="mt-3">
    {{ $suggestions->links('pagination::bootstrap-5') }}
</div>
@endif
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
for(let j=0;j<approveBtns.length;j++){
    approveBtns[j].addEventListener('click',function(){
        let value=disapproveBtns[j].value
        console.log(value)
        $.ajax({
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}" },
            type: "POST",
            url: "{{route('approve')}}",
            contentType: "application/json",
            dataType: "json",
            data: JSON.stringify({suggestion : value }),
            success: function(data){
                let id=value
                if(data.success){
               $()
               $(`#status${id}`).html('<span class="text-success" >Approved</span>');
               $(`.actions${id}`).hide();
                }
            }

        });
    });
}
let disapproveBtns=document.getElementsByClassName('disapprove');
for(let k=0;k<disapproveBtns.length;k++){
    disapproveBtns[k].addEventListener('click',function(){
        let value=disapproveBtns[k].value
        console.log(value)
     $.ajax({
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}" },
            type: "POST",
            url: "{{route('disapprove')}}",
            contentType: "application/json",
            dataType: "json",
            data: JSON.stringify({suggestion : value }),
            success: function(data){
                let id=value
                if(data.success){
               $(`.actions${id}`).hide();
               $(`#status${id}`).html('<span class="text-danger" >Disapproved</span>');
                }
            }

        });
    });
}
</script>
@endsection