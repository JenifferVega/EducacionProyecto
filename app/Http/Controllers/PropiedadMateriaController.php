<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\propiedadMateria;
use App\propiedadeNota;
use App\Materia;
use App\TipoPropiedadMateria;
use App\logro;
use DB;
class PropiedadMateriaController extends Controller
{

  public function index()
  {
   $propiedad_materia = DB::SELECT(DB::RAW("select m.id, g.logro as logro, h.nombre as tipo_propiedad, m.codigo, m.observacion from propiedad_materia as m
    INNER JOIN logros as g on m.logro = g.id INNER JOIN tipos_propiedad_materia as h on m.tipo_propiedad= h.id; "));
    $propiedad_nota = DB::SELECT(DB::RAW("select m.id, g.codigo as propiedad, m.nota ,m.nota_superior from propiedad_nota as m
    INNER JOIN propiedad_materia as g on m.propiedad = g.id;"));
    $tipos_propiedad_materia=TipoPropiedadMateria::All();
    $tipos_propiedad_materiaArray=TipoPropiedadMateria::pluck("nombre","id");
    $materia= Materia::All();
    $notaArray=Materia::pluck("id","id");
    $materiaArray=Materia::pluck("id","id");
    $propiedad_materiaArray=propiedadMateria::pluck("id","id");
    $logros= DB::SELECT(DB::RAW("select m.id, g.nombre as materia, m.logro   from logros as m
    INNER JOIN materia as g on m.materia = g.id;"));
    $materiasArray= Materia::pluck("nombre","id");

    return view("PropiedadMaterias&notas",compact("logros","propiedad_materia","propiedad_nota","tipos_propiedad_materia",
    "materiaArray","materia","tipos_propiedad_materiaArray","propiedad_materiaArray","materiasArray"));
  }


    public function create (Request $request){

      $validacion = propiedadMateria::where("codigo","like","'%".$request->codigo."%'")->get();

      if(count($validacion)  > 0 )
      {
          return redirect('/Materia')->with('status',
           "¡ El valor ".$request->codigo." ya tiene un similar en el sistema !");
      }
      $propiedad_materia= new propiedadMateria();
      $propiedad_materia->codigo = $request->codigo;
      $propiedad_materia->tipo_propiedad = $request->tipo_Propiedad;
      $propiedad_materia->logro = $request->logro;
      $propiedad_materia->observacion = $request->observacion;
      $propiedad_materia->save();
      return redirect('/Materia')->with('status', "!creado!");
    }

      public function edit ($id)  {
          $propiedad_materiaE = propiedadMateria::find($id);
          return response()->json(compact("propiedad_materiaE"));

      }

      public function update(Request $request, $id )
      {

      $sql = "Select * from propiedad_materia where codigo like '%".$request->codigo."%'";
      $validation = DB::SELECT(DB::RAW($sql));

        if(count($validation) == 1)
        {
          if($id==$validation[0]->id)
          {
            return redirect('/Materia')->with('status',
            "¡ El valor ".$request->codigo." ya se ha actualizado!");
          }
          else{
            return redirect('/Materia')->with('status',
            "¡ El valor ".$request->codigo." ya tiene uno similar en el sistema!");
          }
        }
          $propiedad_materiaE = propiedadMateria::find($id);
          $propiedad_materiaE->codigo = $request->codigo;
          $propiedad_materiaE->tipo_propiedad = $request->tipo_Propiedad;
          $propiedad_materiaE->logro = $request->logro;
          $propiedad_materiaE->observacion = $request->observacion;
          $propiedad_materiaE->save();
          return redirect('/Materia')->with('status', "¡Usuario editado!");

      }

      public function delete ($id)
      {
          $propiedad_materiaE = propiedadMateria::find($id);
          $propiedad_materiaE->delete();
          return redirect('/Materia')->with('status', "¡usuario eliminado!");
      }
}
