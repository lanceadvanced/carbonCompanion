@php
    use App\Models\User;
    $user = Auth::user();

    if(!empty($user)){
        $supplierAccount = $user->getAccount(User::SUPPLIER);
        $manufacturerAccount = $user->getAccount(User::MANUFACTURER);
    }
@endphp
@extends('layout')
@section('content')
    @if(!empty($user))
        @if(!empty($supplierAccount))
            <h1>Welcome {{$supplierAccount->supplierName}} (supplier #{{$supplierAccount->getKey()}})</h1>
            <a class="btn btn-outline-primary" href="{{route('manageTokens')}}">Manage API Access</a>
        @endif

        @if(!empty($manufacturerAccount))
            <h1>Welcome {{$manufacturerAccount->manufacturerName}} (manufacturer #{{$manufacturerAccount->getKey()}})<h1>
            <a class="btn btn-outline-primary" href="{{route('manageProducts')}}">Manage products</a>
        @endif
    @else
        <h1>Welcome to carbon companion</h1>
    @endif
@endsection
