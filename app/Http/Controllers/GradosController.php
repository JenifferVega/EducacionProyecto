<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Grados;
use App\AreaConocimientos;
use App\periodos;
use DB;


class GradosController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
      $this->middleware('admin');
    }

    public function index()
    {
      $grados = Grados::All();
      $areas_conocimiento= AreaConocimientos::All();
      $periodo = periodos::All();

      return view("institucionParaMets",compact('grados',"areas_conocimiento","periodo"));
    }
    public function create (Request $request){

      $validacion = Grados::where("nombre","like","%".$request->Nombre."%")->get();

      if(count($validacion)  > 0 )
      {
          return redirect('/ParaMet')->with('status',
           "¡ El valor ".$request->Nombre." ya tiene un similar en el sistema !");
      }

      $grados = new Grados();
      $grados->nombre = $request->Nombre;
    //  print_r ($_REQUEST);
      $grados->save();
      return redirect('/ParaMet')->with('status', "¡Grado creado!");

    }
    public function edit ($id)  {
        $gradosE = Grados::find($id);
        return response()->json(compact("gradosE"));

    }
    public function update(Request $request, $id )
    {

      $sql = "Select * from grados where nombre like '%".$request->Nombre."%'";
      $validation = DB::SELECT(DB::RAW($sql));

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

      $gradosE = Grados::find($id);
      $gradosE->nombre = $request->Nombre;
      $gradosE->save();
      return redirect('/ParaMet')->with('status', "¡Grado editado!");

  }
  public function delete ($id){
      $gradosE = Grados::find($id);
      $gradosE->delete();
      return redirect('/ParaMet')->with('status', "¡Grado eliminado!");
    }

}
