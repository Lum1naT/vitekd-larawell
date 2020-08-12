@extends('base')

@section('title', 'Prouct detail')

@section('content')


<h2> Product: {{ $product->name }}</h2>
<h3> Cost: {{ $product->price }} <br>
      Stock: {{ $product->stock }}

</h3>

<form action="/editProduct" method="post">
  <input type="text" name="name" placeholder="Name" value="{{ $product->name }}"><br>
  <input type="text" name="description" placeholder="Description" value="{{ $product->description }}"><br>
  <input type="text" name="product_code" placeholder="Product Code" value="{{ $product->product_code }}" required><br>
  Price:<input type="number" name="base" placeholder="number" required value="{{ $price_base }}"><b>.</b><input type="number" name="decimal" placeholder="number" value="{{ $price_decimal }}"><br>
  <input type="number" name="stock" placeholder="Stock" value="{{ $product->stock }}"><br>
  {{ csrf_field() }}
  <input type="submit" name="submit" value="Edit product!">

</form>


@endsection
