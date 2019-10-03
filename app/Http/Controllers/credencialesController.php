<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\credencial;
use DB;

class credencialesController extends Controller
{
      public function create(Request $request)
      {


        $validacion = credencial::where("usuario","like","%".$request->Usuario."%")->get();

        if(count($validacion)  > 0 )
        {
            return redirect('/users')->with('status',
             "¡ El valor ".$request->Usuario." ya tiene un similar en el sistema !");
        }


        $credenciales = new credencial();
        $credenciales->username = $request->Username;
        $credenciales->usuario = $request->Usuario;
        $credenciales->password = $request->password;
        $credenciales->save();
        return redirect('/users')->with('status', "¡usuario creado!");
      }

      public function edit ($id)  {
          $credencialesE = credencial::find($id);
          return response()->json(compact("credencialesE"));

      }
      public function update(Request $request, $id )
      {

          $sql = "Select * from credenciales where usuario like '%".$request->Usuario."%'";
          $validation = DB::SELECT(DB::RAW($sql));
          //print_r($validation[0]);
        //  print_r (count($validation));

            if(count($validation) == 1)
            {
              if($id==$validation[0]->id)
              {
                return redirect('/users')->with('status',
                "¡ El valor ".$request->Usuario." ya se ha actualizado!");
              }
              else{
                return redirect('/users')->with('status',
                "¡ El valor ".$request->Usuario." ya tiene uno similar en el sistema!");
              }
            }



          $credencialesE = credencial::find($id);
          $credencialesE->username = $request->Username;
          $credenciales->usuario = $request->Usuario;
          $credenciales->password = $request->password;
          $credencialesE->save();
          return redirect('/users')->with('status', "¡credencial editada!");


      }

      public function delete ($id){
          $credencialesE = credencial::find($id);
          $credencialesE->delete();
          return redirect('/users')->with('status', "¡credencial eliminado!");
        }




}
