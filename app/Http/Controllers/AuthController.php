<?php

namespace App\Http\Controllers;

use App\Mail\ChangePwMail;
use App\Mail\SuccPwChangeMail;
use App\Mail\VerifyEmailMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function getSignUp() {
        return view('auth.signup');
    }

    public function getSignIn() {
        return view('auth.signin');
    }

    public function getForgotPw() {
        return view('auth.forgotpw');
    }

    public function getChangePw($id) {
        return view('auth.changepw', compact('id'));
    }

    public function getSettings() {
        $id = Auth::user()->id;
        return view('settings', compact('id'));
    }

    public function signUp(Request $request) {
        if(Auth::check()) {
            return redirect('/signup')->withErrors('You are already signed in!');
        }

        $request->validate([
            'name' => 'required|min:3|max:255|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3|max:255|string|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $mailData = $user->only('id');
        Mail::to($user->email)->send(new VerifyEmailMail($mailData));
        
        return redirect('/signup')->with('status', 'You have successfully signed up!');
    }

    public function signIn(Request $request) {
        if(Auth::check()) {
            return redirect('/signup')->withErrors('You are already signed in!');
        }

        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)) {
            return redirect()->intended('/')->with('status', 'You have signed in successfully!');
        }

        return redirect('/signin')->withErrors('Invalid credentials');
    }

    public function signOut() {
        Session::flush();
        Auth::logout();
        return redirect('/signin')->with('status', 'You have signed out!');
    }

    public function forgotPw(Request $request) {
        $request->validate([
            'email' => 'required|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->get()[0];
        $mailData = $user->only('id');
        Mail::to($user->email)->send(new ChangePwMail($mailData));

        return redirect('/')->with('status', 'An email has been sent with instructions to change password.');
    }  

    public function changePw(Request $request) {
        $request->validate([
            'password' => 'required|min:3|max:255|string|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = User::find($request->id);
        $user->password = Hash::make($request->password);
        $user->save();
        if(Auth::check()){
            return redirect('/settings')->with('status', 'Password changed successfully.');
        }
        return redirect('/signin')->with('status', 'Password changed successfully.');
    }

    public function newPw(Request $request) {
        $request->validate([
            'old_password' => 'required|min:3|max:255|string',
            'password' => 'required|min:3|max:255|string|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = Auth::user();
        $user = User::find($user->id);
        // dd(Hash::make($request->old_password));
        // dd($user->password);
        // $newpass = Hash::make($request->old_password);
        if(Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            Mail::to($user->email)->send(new SuccPwChangeMail());
            return redirect('/signout')->with('status', 'Password changed successfully.');
        }

        return redirect('/settings')->withErrors('Invalid password.');
    }

    public function verify($id) {
        $user = User::find($id);
        if(!$user->email_verified_at) {
            $user->email_verified_at = date("Y-m-d h:i:sa");
            $user->save();
            return redirect('/')->with('status', 'Email has been verified!');
        }
          
        return redirect('/')->withErrors('Email already verified!');
    }
}
