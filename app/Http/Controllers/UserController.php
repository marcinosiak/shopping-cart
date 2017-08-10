<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Auth;
use Session;

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

      //po zapisaniu do bazy od razu loguję nowego usera
      Auth::login($user);
      /**
       * Ustawiam powrót do poprzedniej strony, np.
       * jestem w koszyku z dodanymi produktami, nie mam konta, po przejściu do płatności, przekierowuje mnie
       * na stronę logowania. Po zalogowaniu lub założeniu nowego konta powracam automatycznie do podsumowania płatności.
      */
      if (Session::has('oldUrl'))
      {
        $oldUrl = Session::get('oldUrl');
        Session::forget('oldUrl');
        return redirect()->to($oldUrl);
      }

      return redirect()->route('user.profile');
    }

    //Wyświetla formularz logowania
    public function getSignin()
    {
      return view('user.signin');
    }

    /**
     * Logowanie użytkownika
     * @param  Request $request [description]
     * @return [type]           [przekierowanie]
     */
    public function postSignin(Request $request)
    {
      $this->validate($request, [
        'email' => 'email|required',
        'password' => 'required|min:4'
      ]);

      if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')]))
      {
        /**
         * Ustawiam powrót do poprzedniej strony, np.
         * jestem w koszyku z dodanymi produktami, nie mam konta, po przejściu do płatności, przekierowuje mnie
         * na stronę logowania. Po zalogowaniu lub założeniu nowego konta powracam automatycznie do podsumowania płatności.
        */
        if (Session::has('oldUrl'))
        {
          $oldUrl = Session::get('oldUrl');
          Session::forget('oldUrl');
          return redirect()->to($oldUrl);
        }

        return redirect()->route('user.profile');
      }

      return redirect()->back();
    }

    //Wyświetla profil użytkownika
    public function getProfile()
    {
      return view('user.profile');
    }

    /**
     * Wylogowanie użytkownika
     * @return [type] [description]
     */
    public function getLogout()
    {
      Auth::logout();
      return redirect()->route('user.signin');
      //return redirect()->back();
    }
}
