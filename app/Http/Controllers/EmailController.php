<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use SendGrid\Mail\Mail as SendGridMail;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    //
    public function exibirFormulario()
    {
        return view('auth.route-verify');
    }

    public function VerificarEmail($id, Request $request)
    {
        $user = User::find($id);
        if ($user) {
            $user->email_verified_at = now();
            $user->update();
            return redirect(RouteServiceProvider::LOGIN);
        } else {
            return response()->view('errors.404', [], 404);
        }
    }

    public function exibirFormularioVerificado($id)
    {
        $user = User::find($id);
        if ($user) {
            return view('auth.verificado', compact('user'));
        } else {
            return response()->view('errors.404', [], 404);
        }
    }
}
