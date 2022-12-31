<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use App\Models\Supplier;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return View
     */
    public function create(): View
    {
        return view('register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param Request $request
     * @return RedirectResponse
     *
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'company' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'type' => ['required', Rule::in([User::MANUFACTURER, User::SUPPLIER])]
        ]);

        $user = [
            'name' => $request->get('email'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ];

        $user = User::create($user);

        if($request->get('type') == User::MANUFACTURER){
            Manufacturer::create([
                'manufacturerName' => $request->get('company'),
                'fk_userID' => $user->getKey(),
                'active' => 1
            ]);
        } else {
            Supplier::create([
               'supplierName' => $request->get('company'),
               'fk_userID' => $user->getKey(),
               'active' => 1
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
