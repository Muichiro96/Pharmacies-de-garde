<head><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

<link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">

<link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

<link rel="stylesheet" href="/dist/css/adminlte.min.css?v=3.2.0">
</head>
<body>
    <br/>
    <div class="container"><div class="row"><div class="col"><div class="card">
    <div class="card-header">
    <h3 class="card-title">Tasks Table</h3>
    </div>
    
    <div class="card-body">
    <table class="table table-bordered">
    <thead>
    <tr>
    <th style="width: 10px">#</th>
    <th>Task</th>
    <th>Description</th>
    <th>status</th>
    
    </tr>
    </thead>
    <tbody>
        @foreach($tasks as $task)
    <tr>
    <td>{{ $loop->index + 1 }}</td>
    <td>{{ $task->name}}</td>
    <td>{{  $task->description}}</td>
    <td>{{  $task->status}}</td>
    <td>
        <a href="{{ route('edit',$task->idTask) }}"><button class="btn btn-warning"><i class="fa fa-pen"></i></button></a>
   
    <a href="{{ route('delete',$task->idTask) }}"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a></td>
    </tr>
    @endforeach
    </tbody>
    </table>
    </div>
    
   
    </div></div> </div></div>