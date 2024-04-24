@extends('layout')

@section('sec','registration')
     


@section('content')

   <div class="container" >

   <form action="{{ route('registrationpost') }}" method="POST" class="ms-auto me-auto mt-auto" style="width:500px">

    @csrf
  <div class="mb-3">
    <label class="form-label">Name</label>
    <input  type="text"  class="form-control"  name="name">
   
  </div>

  <div class="mb-3">
    <label class="form-label">Email</label>
    <input  type="email"  class="form-control"  name="email">
   
  </div>

  <div class="mb-3">
    <label class="form-label">Password</label>
    <input  type="password"  class="form-control"  name="password">
</div>
   
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif






</div>
 
 @endsection