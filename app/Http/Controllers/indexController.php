<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;

class indexController extends Controller
{

    public function __construct(){
      $this->middleware('auth');

      //$this->middleware('admin');
    }

    public function index(){
      return view("login");
    }


    public function home() {
      return view("home");
    }


    public function boletin() {
      return view("GestionarBoletin");
    }


}
