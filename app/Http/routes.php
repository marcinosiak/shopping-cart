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

//Wyświetla profil użytkownika
Route::get('/user/profile', [
  'uses' => 'UserController@getProfile',
  'as' => 'user.profile'
]);
