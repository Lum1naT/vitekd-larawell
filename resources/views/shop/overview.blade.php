@extends('base')

@section('title', 'Přehled produktů')

@section('content')

@foreach ($products as $product)
    <p>This is product: {{ $product->id }}</p>
@endforeach


@endsection
