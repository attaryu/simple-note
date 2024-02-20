<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SignController extends Controller
{
    protected $validation = [
        'name' => 'min:8|max:32|required',
        'email' => 'email:rfc|required', /* unique:App\Models\User,email| */
        'password' => 'min:8|required',
    ];

    public function renderLoginPage(Request $request): View
    {
        return view('pages.sign.login');
    }

    public function renderSignInPage(): View
    {
        return view('pages.sign.sign-in');
    }

    public function signIn(Request $request)
    {
        $request->validate([
            ...$this->validation,
            'password' => $this->validation['password'] . '|confirmed',
        ]);

        $payload = $request->only([
            'name',
            'email',
            'password',
        ]);

        $user = new User();

        $user->name = $payload['name'];
        $user->email = $payload['email'];
        $user->password = $payload['password'];

        $user->save();

        return response()->redirectToRoute('auth.loginPage');
    }

    public function login(Request $request)
    {
        $validation = array_filter($this->validation, function ($key) {
            return $key !== 'name';
        }, ARRAY_FILTER_USE_KEY);

        $request->validate($validation);
        $payload = $request->only(['email', 'password']);

        if (Auth::attempt($payload)) {
            $request->session()->regenerate();
            return redirect()->intended();
        }

        return back()->withErrors(['login' => 'Credentials does not match our records']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }
}
