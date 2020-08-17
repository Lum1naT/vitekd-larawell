@extends('base')

@section('title', 'Account Detail')

@section('content')

  <h2>Create a product: </h2>
  <form action="/createProduct" method="post">
    <input type="text" name="name" placeholder="Name"><br>
    <input type="text" name="description" placeholder="Description"><br>
    <input type="text" name="product_code" placeholder="Product Code" required><br>
    Price:<input type="number" name="base" placeholder="number" required value="0"><b>.</b><input type="number" name="decimal" placeholder="number" value="00"><br>
    <input type="number" name="stock" placeholder="Stock"><br>
    {{ csrf_field() }}
    <input type="submit" name="submit" value="Create Product!">

  </form>

  <h2>Categories:</h2>
  <ul>
    @foreach($categories as $category)
    <li> <b> {{ $category->name }} </b>
    </li>
    @endforeach

  <h2>Products:</h2>
  <ul>
    @foreach($products as $product)
    <li> <b><a href={{ url('product/'.$product->id) }}> {{ $product->name }} </a> </b> > {{ $product->description }}
      <br> costs: {{ $product->price }}
      <br> stock: {{ $product->stock }}
    </li>


    @endforeach
  </ul>

@endsection
