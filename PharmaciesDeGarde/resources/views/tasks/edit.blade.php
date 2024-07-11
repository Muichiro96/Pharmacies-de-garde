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
    <div class="card card-primary">
    <div class="card-header">
    <h3 class="card-title">General</h3>
    <div class="card-tools">
    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
    <i class="fas fa-minus"></i>
    </button>
    </div>
    </div>
    <div class="card-body">
    <div class="form-group">
        <form method="post">
            @csrf
    <label for="inputName">Task Name</label>
    <input type="text" id="inputName" class="form-control" name="name" value="{{ $task->name }}">
    </div>
    <div class="form-group">
    <label for="inputDescription">Task Description</label>
    <textarea id="inputDescription" class="form-control" name="description" rows="4">{{ $task->description }}</textarea>
    </div>
    <div class="form-group">
    <label for="inputStatus">Status</label>
    <select id="inputStatus" name="status" class="form-control custom-select">
    <option disabled="">Select one</option>
    <option>Planning</option>
    <option>Done</option>
    <option selected="">{{ $task->status }}</option>
    </select>
    
   
    
    </div>
    
    </div><div class="card-footer">
        <button type="submit" class="btn btn-warning">Edit</button></div>
        </div></div></div></body></html>