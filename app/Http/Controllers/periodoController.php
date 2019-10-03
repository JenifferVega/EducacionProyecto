<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\periodos;
use DB;

    class periodoController extends Controller
    {

    public function create (Request $request){

      $validacion = periodos::where("nombre","like","%".$request->Nombre."%")->get();

      if(count($validacion)  > 0 )
      {
          return redirect('/ParaMet')->with('status',
           "¡ El valor ".$request->Nombre." ya tiene un similar en el sistema !");
      }

      $periodo = new periodos();
      $periodo->nombre = $request->Nombre;
    //  print_r ($_REQUEST);
      $periodo->save();
      return redirect('/ParaMet')->with('status', "¡Grado creado!");

    }
    public function edit ($id)  {
        $periodoE = periodos::find($id);
        return response()->json(compact("periodoE"));

    }

    public function update(Request $request, $id )
    {
      $sql = "Select * from periodo where nombre like '%".$request->Nombre."%'";
      $validation = DB::SELECT(DB::RAW($sql));
      //print_r($validation[0]);
    //  print_r (count($validation));

        if(count($validation) == 1)
        {
          if($id==$validation[0]->id)
          {
            return redirect('/ParaMet')->with('status',
            "¡ El valor ".$request->Nombre." ya se ha actualizado!");
          }
          else{
            return redirect('/ParaMet')->with('status',
            "¡ El valor ".$request->Nombre." ya tiene uno similar en el sistema!");
          }
        }

        $periodoE = periodos::find($id);
        $periodoE->nombre = $request->Nombre;
        $periodoE->save();
        return redirect('/ParaMet')->with('status', "¡Grado editado!");

    }

    public function delete ($id){
        $periodoE = periodos::find($id);
        $periodoE->delete();
        return redirect('/ParaMet')->with('status', "¡Grado eliminado!");
      }

    }
