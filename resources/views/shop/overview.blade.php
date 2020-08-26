@extends('base')

@section('title', 'Přehled produktů')

@section('content')
<div class="container">
  <div class="row justify-content-around">


    @foreach ($products as $product)
    <div class="col-3">

    <div class="card">
  <img class="card-img-top" src="..." alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"> {{ $product->name }} </h5>
    <p class="card-text">{{ $product->description }}</p>
    <a href="#" class="btn btn-primary">Detail</a>
  </div>
</div>




    </div>

    @endforeach


  </div>
</div>




@endsection
