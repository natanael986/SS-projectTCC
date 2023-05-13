<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPermission;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use SendGrid\Mail\Mail as SendGridMail;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name_id' => 'required|unique:users',
            'name' => ['required', 'string', 'max:255'],
            // 'image' => ['required', 'string', 'max:255'],
            // 'ano_nascimento' => ['required', 'integer', 'max:4'],
            // 'name_id' => ['required', 'string', 'name_id', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            return redirect(RouteServiceProvider::LOGIN)
                ->withErrors($validator)
                ->withInput();
        }

        // $user = new User;
        // $user->name = $request->name;
        // $user->name_id = $request->name_id;
        // $user->email = $request->email;
        // $user->ano_nascimento = $request->ano_nascimento;
        // $user->password = Hash::make($request->password);
        // $user->givePermissionTo('user')->save();

        $user = User::create([
            'name' => $request->name,
            'name_id' => $request->name_id,
            'email' => $request->email,
            'ano_nascimento' => $request->ano_nascimento,
            'password' => Hash::make($request->password),
        ])->givePermissionTo('user');

        event(new Registered($user));

        Auth::logout($user);

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        $username =  $user->name_id;
        $user_id =  $user->id;


        $email = new SendGridMail();
        $email->setFrom("tccprojeto395@gmail.com", "Stret Slang");
        $email->addTo($user->email, $user->name);
        $email->setSubject('Verifique seu email');
        $email->addContent(
            "text/html",
            view('auth.verify-email', compact('verificationUrl', 'username', 'user_id'))->render()
        );

        $sendgrid = new \SendGrid(config('services.sendgrid.api_key'));
        $sendgrid->send($email);

        return redirect(RouteServiceProvider::VERIFYEMAIL);
    }
}
