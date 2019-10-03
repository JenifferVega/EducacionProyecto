<?php

namespace App\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;

use App\Usuarios;

use Closure;

class admin
{

      protected $auth;
      public function __construct(Guard $auth)
      {
          $this->auth = $auth;
      }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
  //  public function handle($request, Closure $next)
//    {
//        if($this->auth->user()->rol !=1)
  //      {
    //      return redirect ('home')->with('status', "!No permitido!");
      //  }
      //    return $next ($request);
//    }


    public function handle($request, Closure $next)
      {
          if(Usuarios::find($this->auth->user()->usuario)->rol !=1)
          {

            return redirect ('home')->with('status', "!No permitido!");

          }

            return $next ($request);
    }
  }
