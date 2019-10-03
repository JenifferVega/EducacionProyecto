<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\logro;
use App\Materia;

class logrosController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
    $this->middleware('admin');
  }

  public function create (Request $request){

    $logros= new logro();
    $logros->materia =$request->materia;
    $logros->logro = $request->logro;
    $logros->save();
    return redirect('/Materia')->with('status', "!creado!");
  }

  public function edit ($id)  {
      $logrosE = logro::find($id);
      return response()->json(compact("logrosE"));

  }
  public function update(Request $request, $id )
  {

      $logrosE = logro::find($id);
      $logrosE->materia =$request->materia;
      $logrosE->logro = $request->logro;
      $logrosE->save();
      return redirect('/Materia')->with('status', "¡Usuario editado!");

  }
  public function delete ($id)
  {
      $logrosE =logro::find($id);
      $logrosE->delete();
      return redirect('/Materia')->with('status', "¡usuario eliminado!");
  }
}
