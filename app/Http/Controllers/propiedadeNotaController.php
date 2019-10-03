<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\propiedadeNota;
use DB;

class propiedadeNotaController extends Controller
{
  public function create (Request $request){

    $validacion = propiedadeNota::where("propiedad","like","%".$request->propiedad."%")->get();

    if(count($validacion)  > 0 )
    {
        return redirect('/ParaMet')->with('status',
         "¡ El valor ".$request->Propiedad." ya tiene un similar en el sistema !");
    }

    $propiedad_nota= new propiedadeNota();
    $propiedad_nota->nota = $request->nota;
    $propiedad_nota->propiedad = $request->propiedad;
    $propiedad_nota->nota_superior= $request->notaSuperior;
    $propiedad_nota->save();
    return redirect('/Materia')->with('status', "!creado!");


}

      public function edit ($id)  {
          $propiedad_notaE = propiedadeNota::find($id);
          return response()->json(compact("propiedad_notaE"));

      }

      public function update(Request $request, $id )
      {


          $propiedad_notaE =propiedadeNota::find($id);
          $propiedad_notaE->nota = $request->nota;

          $propiedad_notaE->save();
          return redirect('/Materia')->with('status', "¡Usuario editado!");

      }

      public function delete ($id)
      {
          $propiedad_notaE = propiedadeNota::find($id);
          $propiedad_notaE->delete();
          return redirect('/Materia')->with('status', "¡usuario eliminado!");
      }

}
