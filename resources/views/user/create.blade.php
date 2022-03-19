@extends('user.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add new</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('user.index') }}"> Back</a>
        </div>
    </div>
</div>
     
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="post" action="{{ route('user.store') }}">
@method('POST')
@csrf
    <div class="col-xs-12 col-sm-12 col-md-12">
        <label for="exampleInputPassword1" class="form-label">First Name</label>
        <input type="text" name="nama_depan" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <label for="exampleInputEmail1" class="form-label">Last Name</label>
        <input type="text" name="nama_belakang" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="form-group">
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
      <button type="submit" class="btn btn-primary">Create</button>
    </div>
    </div>
</form>
@endsection