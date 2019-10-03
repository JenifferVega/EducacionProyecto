<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Credencial extends Authenticatable
{
      protected $table = "credenciales";

      protected $hidden = [
          'password', 'remember_token',
      ];

      public function setPasswordAttribute($valor)
       {
         if(!empty($valor))
          {
            $this->attributes['password'] = \Hash::make($valor);
          }
       }


      public function systemUser()
      {
        return $this->hasOne('App\Usuarios', 'id', 'usuario');
      }

}
