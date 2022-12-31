@extends('layout')
@section('content')
    <h1>Register</h1>
    <form method="post" class="w-50" action="{{route('register')}}">
        @csrf
        <label class="form-label" for="company">Company:&nbsp;</label>
        <input class="form-control" type="text" name="company" id="company" value="{{old('company')}}">
        <br>
        @foreach($errors->get('company') as $error)
            <br>{{$error}}
        @endforeach
        <div class="alert alert-info mb-1">As a manufacturer, you can record your products and their carbon footprint.</div>
        <label class="form-check-label" for="typeManufacturer">Register as manufacturer: </label>
        <input class="form-check-input" type="radio" name="type" id="typeManufacturer" value="manufacturer" {{old('type') == 'manufacturer' ? 'checked' : ''}}><br>
        <br>
        <div class="alert alert-info mb-1">As a supplier, you can create your personal tokens to access the data stored at CarbonCompanion.</div>
        <label class="form-check-label" for="typeSupplier">Register as supplier: </label>
        <input class="form-check-input" type="radio" name="type" id="typeSupplier" value="supplier" {{old('type') == 'supplier' ? 'checked' : ''}}>
        @foreach($errors->get('type') as $error)
            <br>{{$error}}
        @endforeach
        <br>
        <br>
        <label class="form-label" for="email">Email:&nbsp;</label>
        <input class="form-control" type="email" name="email" id="email" value="{{old('email')}}">
        @foreach($errors->get('email') as $error)
            <br>{{$error}}
        @endforeach
        <br>
        <label class="form-label" for="password">Password:&nbsp;</label>
        <input class="form-control" type="password" name="password" id="password">
        @foreach($errors->get('password') as $error)
            <br>{{$error}}
        @endforeach
        <br>
        <label class="form-label" for="password_confirmation">Repeat:&nbsp;</label>
        <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
        @foreach($errors->get('password_confirmation') as $error)
            <br>{{$error}}
        @endforeach
        <br>
        <input class="btn btn-primary" type="submit" value="Register">
    </form>
@endsection
