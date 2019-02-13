@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4 mt-5 bg-light rounded">
        <h1 class="text-center font-weight-bold text-primary">Edit record #{{ $record->id }}</h1>
        <hr class="bg-light">
        <h5 class="text-center text-success"></h5>
        <form method="post" id="form-box" class="p-2">

          {{ csrf_field() }}

          <div class="form-group input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Name</span>
            </div>
            <input value="{{ $record->name }}" type="text" name="name" class="form-control" placeholder="Enter name" required>
          </div>

          <div class="form-group input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Name-Group</span>
            </div>
            <input value="{{ $record->group }}" type="text" name="group" class="form-control" placeholder="Enter name-group" required>
          </div>

          <div class="form-group input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Genre</span>
            </div>
            <input value="{{ $record->genre }}" type="text" name="genre" class="form-control" placeholder="Enter Genre" required>
          </div>

          <div class="form-group input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Title</span>
            </div>
            <textarea name="title" class="form-control" rows="6" placeholder="Enter Title">{{ $record->title }}</textarea> 
          </div>

            <input type="submit" name="Edit" id="submit" class="btn btn-primary btn-block" value="Edit">
          </div>
 
        </form>
      </div>
    </div>
  </div>	
@endsection