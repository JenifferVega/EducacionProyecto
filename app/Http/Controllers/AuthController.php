<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Redirect;

class AuthController extends Controller
{

  public function __construct()
  {
    $this->middleware('web');
    $this->middleware('guest', ['except' => 'logout']);
  }

  public function index()
  {
    return view("login");
  }

  public function login()
  {
    $credentials = request(['username', 'password']);

      if (Auth::attempt($credentials)) {
          return redirect('/home');
      }
      else
      {
            return redirect('/login')->with('status', "¡Los datos suministrados son incorrectos!");
      }

  }

  public function logout(){
    Auth::logout();
    return Redirect::to('/');
    //return redirect('/login')->with('status', "¡Sesión finalizada exitosamente!");
    //print_r($_SESSION);
  }

}
