<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Auth;

class UserController extends Controller
{
    //Wyświetla formularz rejestracji
    public function getSignup()
    {
      return view('user.signup');
    }

    /**
    * Pobiera dane z formularza,
    * waliduje dane,
    * zapisuje użytkownika do bazy,
    * przekierowuje do widoku wszystkich książek, używając aliasu product.index
    */
    public function postSignup(Request $request)
    {
      $this->validate($request, [
        'email' => 'email|required|unique:users',
        'password' => 'required|min:4'
      ]);

      $user = new User([
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password'))
      ]);
      $user->save();

      return redirect()->route('product.index');
    }

    //Wyświetla formularz logowania
    public function getSignin()
    {
      return view('user.signin');
    }

    public function postSignin(Request $request)
    {
      $this->validate($request, [
        'email' => 'email|required',
        'password' => 'required|min:4'
      ]);

      if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')]))
      {
        return redirect()->route('user.profile');
      }

      return redirect()->back();
    }

    public function getProfile()
    {
      return view('user.profile');
    }

}
