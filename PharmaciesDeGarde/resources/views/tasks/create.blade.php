<head><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  
  <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  
  <link rel="stylesheet" href="/dist/css/adminlte.min.css?v=3.2.0">
  </head>
  <body class="login-page">
@if($errors->any())
<div class="alert alert-danger alert-dismissible" width="100%">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

<ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
<ul>
</div> 

@endif
@if(session()->has('message'))
<div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h4><i class="icon fa fa-check"></i> Success!</h4>
{{ session()->get('message') }}.Please Log In !
</div>
@endif
<div class="container">
  <div class="row">
    <div class="col">
<div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Task Form</h3>
              </div>
             
              <form class="form-horizontal" method="post">
                @csrf 
                <div class="card-body">
                  <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Task name :</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" class="form-control"  placeholder="Do my homework...">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="description" class="col-sm-2 col-form-label">Description :</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" name="description" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Status :</label>
                    <select id="inputStatus" name="status" class="form-control custom-select">
                    <option disabled="">Select one</option>
                    <option>Planning</option>
                    <option>Done</option>
                    <option selected="">To Do</option>
                    </select>
                    
                   
                    
                    </div>
                </div>
              
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Create</button>
                  <button class="btn btn-default float-right">Cancel</button>
                </div>
                
              </form>
            </div></div></div></div></body></html>