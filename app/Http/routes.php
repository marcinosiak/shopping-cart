<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Wyświetla wszystkie książki
Route::get('/', [
  'uses' => 'ProductController@getIndex',
  'as' => 'product.index'
]);

//Dodaje produkt do koszyka o określonym id
Route::get('/add-to-cart/{id}', [
  'uses' => 'ProductController@getAddToCart',
  'as' => 'product.addToCart'
]);

//Grupuję ścieżki związane z użytkownikiem
//nie muszę teraz dodawać przedrostka /user
//zamiast /user/signup zapisuję /signup
Route::group(['prefix' => 'user'], function(){

  //Grupuję ścieżki związane z dostępem do poszczegolnych stron
  //Tutaj dla niezalogowanych użytkownikw
  Route::group(['middleware' => 'guest'], function(){

      //Wyświetla formularz rejestracji
      Route::get('/signup', [
        'uses' => 'UserController@getSignup',
        'as' => 'user.signup'
      ]);

      //Zapisuje użytkownika do bazy
      Route::post('/signup', [
        'uses' => 'UserController@postSignup',
        'as' => 'user.signup'
      ]);

      //Wyświetla formularz logowania
      Route::get('/signin', [
        'uses' => 'UserController@getSignin',
        'as' => 'user.signin'
      ]);

      //Loguje użytkownika do systemu
      Route::post('/signin', [
        'uses' => 'UserController@postSignin',
        'as' => 'user.signin'
      ]);

  });

  //Grupuję ścieżki związane z dostępem do poszczegolnych stron
  //Tutaj dostęp tylko dla zalogowanych użytkownikw
  Route::group(['middleware' => 'auth'], function(){

      //Wyświetla profil użytkownika
      Route::get('/profile', [
        'uses' => 'UserController@getProfile',
        'as' => 'user.profile'
      ]);

      //Wylogowanie użytkownika
      Route::get('/logout', [
        'uses' => 'UserController@getLogout',
        'as' => 'user.logout'
      ]);

  });



});
