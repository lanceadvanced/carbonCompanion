@extends('layout')
@section('content')
    <a href="{{route('manageProducts')}}">Back to Products</a>
    <br>
    <br>
    <h2>Edit "{{$variant->title}}"</h2>
    <form method="post" class="w-50" action="{{route('saveVariant')}}">
        @csrf
        <input type="hidden" name="variantID" value="{{$variant->getKey()}}">
        @include('variantForm')
        <br>
        <input class="btn btn-primary" type="submit" value="Save changes">
    </form>
@endsection
