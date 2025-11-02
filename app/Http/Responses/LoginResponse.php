<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        if ($user->role !== 'admin') {
            auth()->logout();
            return back()->withErrors([
                'email' => 'You are not allowed to login with user account.'
            ]);
        }

        return redirect()->intended(config('fortify.home'));
    }
}
