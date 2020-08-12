@extends('base')

@section('title', 'Error!')

@section('content')


    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->productCreate->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endsection
