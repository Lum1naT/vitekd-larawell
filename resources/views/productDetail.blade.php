@extends('base')

@section('title', 'Prouct detail')

@section('content')


<h2> Product: {{ $product->name }}</h2>
<h3> Cost: {{ $product->price }} <br>
      Stock: {{ $product->stock }}

</h3>

@endsection
