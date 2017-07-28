<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;

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

}
