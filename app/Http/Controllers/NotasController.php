<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nota;
use App\periodos;
use App\Roles;
use App\Materia;

class NotasController extends Controller
{
  public function create (Request $request){

    $validacion =  Nota::where("estudiante","like","%".$request->Estudiante."%")->get();

    if(count($validacion)  > 0 )
    {
        return redirect('/Math')->with('status',
         "¡ El valor ".$request->Estudiante." ya tiene un similar en el sistema !");
    }

    $notas = new Nota();
    $notas->logro = $request->logro;
    $notas->calificacion = $request->Calificacion;
    $notas->periodo = $request->Periodo;
    $notas->estudiante = $request->Estudiante;
    //print_r ($_REQUEST);
    $notas->save();
    return redirect('/Math')->with('status', "¡Grado creado!");

  }

  public function edit ($id)  {
      $notasE = Nota::find($id);
      return response()->json(compact("notasE"));
  }

  public function update(Request $request, $id )
  {

      $notasE = Nota::find($id);
      $notasE->logro = $request->logro;
      $notasE->calificacion = $request->Calificacion;
      $notasE->periodo = $request->Periodo;
      $notasE->estudiante = $request->Estudiante;
      $notasE->save();
      return redirect('/Math')->with('status', "¡Grado editado!");

  }

  public function delete ($id){
      $notasE = Nota::find($id);
      $notasE->delete();
      return redirect('/Math')->with('status', "¡Grado eliminado!");
    }

}
