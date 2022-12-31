@extends('layout')
@section('content')
    <h1>Login</h1>
    <form method="post" class="w-50" action="{{route('login')}}">
        @csrf
        <label class="form-label" for="email">Email</label>
        <input class="form-control" type="email" name="email" id="email">
        <br>
        <label class="form-label" for="password">Password</label>
        <input class="form-control" type="password" name="password" id="password">
        <br>
        <input class="btn btn-primary" type="submit" value="Login">
    </form>
@endsection
