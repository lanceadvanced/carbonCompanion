<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public static function createToken(Request $request): RedirectResponse
    {
        $request->validate([
            'tokenName' => ['required', 'string', 'max:255'],
        ]);

        $token = Auth::user()->createToken($request->get('tokenName'));

        return redirect(route('manageTokens'))->with([
            'createdToken' => $token
        ]);
    }

    public static function delete($tokenID): RedirectResponse
    {
        $token = Auth::user()->tokens()->find($tokenID);
        if(!empty($token)){
            $token->delete();
        }
        return redirect(route('manageTokens'));
    }
}
