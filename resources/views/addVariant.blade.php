@extends('layout')
@section('content')
    <a href="{{route('manageProducts')}}">Back to Products</a>
    <br>
    <br>
    <h2>Add variant to product "{{$product->title}}".</h2>
    <form method="post" class="w-50" action="{{route('createVariant')}}">
        @csrf
        <input type="hidden" name="productID" value="{{$product->getKey()}}">
        @include('variantForm')
        <br>
        <input class="btn btn-primary" type="submit" value="Save changes">
    </form>
@endsection
