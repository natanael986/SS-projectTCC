<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $routeName = Route::currentRouteName();
        return view('auth.login', compact('routeName'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $loginType = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'name_id';

        $request->merge([$loginType => $request->input('email')]);


        // COMENTE ESTE TREICHO PARA PULAR A VERIFICAÇÃO DE EMAIL
        $user = User::where($loginType, $request->email)->first();

        if ($user) {
            if ($user->email_verified_at == null) {
                return redirect(RouteServiceProvider::VERIFYEMAIL);
            } else {
                if (Auth::attempt($request->only($loginType, 'password'), $request->filled('remember'))) {
                    $request->session()->regenerate();
                    return redirect()->intended(RouteServiceProvider::HOME);
                }
            }
        }

        // DESCOMENTE ESTE TREICHO PARA PULAR A VERIFICAÇÃO DE EMAIL
        // if (Auth::attempt($request->only($loginType, 'password'), $request->filled('remember'))) {
        //     $request->session()->regenerate();
        //     return redirect()->intended(RouteServiceProvider::HOME);
        // }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
