@php
    use Illuminate\Support\Collection;
    /* @var Collection $tokens */
@endphp
@extends('layout')
@section('content')
    <h2>Create new access token</h2>
    <form method="post" class="w-50" action="{{route('createToken')}}">
        @csrf
        <label class="form-label d-none" for="tokenName"></label>
        <input class="form-control" type="text" placeholder="Token name" id="tokenName" name="tokenName">
        @foreach($errors->get('tokenName') as $error)
            @if(!$loop->first)<br>@endif{{$error}}
        @endforeach
        <br>
        <input class="btn btn-primary" type="submit" value="Create new token">
    </form>
    @if(!$tokens->isEmpty())
        <hr>
        <h2>Access tokens</h2>
        <table class="table table-striped">
            <tr>
                <th>Hash</th>
                <th>Name</th>
                @if(!empty($createdToken))
                    <th>Plain text token</th>
                @endif
                <th></th>
            </tr>
            @foreach($tokens as $token)
                @php
                    $isCreatedToken = false;
                    /* @var $token */
                    if(isset($createdToken)){
                        if($createdToken->accessToken->id == $token->id){
                            $isCreatedToken = true;
                        }
                    }
                @endphp
                <tr>
                    <td>{{$token->token}}</td>
                    <td>{{$token->name}}</td>
                    @if(!empty($createdToken))
                        @if(!empty($isCreatedToken))
                            <td class="table-success">{{$createdToken->plainTextToken}}</td>
                        @else
                            <td></td>
                        @endif
                    @endif
                    <td><a href="{{route('deleteToken', ['tokenID' => $token->id])}}">Delete token</a></td>
                </tr>
            @endforeach
        </table>
    @endif
@endsection
