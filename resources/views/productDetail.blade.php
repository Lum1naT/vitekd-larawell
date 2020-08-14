@extends('base')

@section('title', 'Prouct detail')

@section('content')

<h1>Product Detail</h1>

<form action="/editProduct" method="post">
  Name:<input type="text" name="name" placeholder="Name" value="{{ $product->name }}"><br>
  Description:<input type="text" name="description" placeholder="Description" value="{{ $product->description }}"><br>
  Product code:<input type="text" name="product_code" placeholder="Product Code" value="{{ $product->product_code }}" required><br>
  Price:<input type="number" name="base" placeholder="number" required value="{{ $price_base }}"><b>.</b><input type="number" name="decimal" placeholder="number" value="{{ $price_decimal }}"><br>
  Stock:<input type="number" name="stock" placeholder="Stock" value="{{ $product->stock }}"><br>
  {{ csrf_field() }}
  <input type="submit" name="submit" value="Edit product!">

</form>


@endsection
