<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoPropiedadMateria;
use DB;

class TiposPropiedadMateriaController extends Controller
{
      $validacion = TipoPropiedadMateria::where("nombre.","like","%".$request->Nombre."%")->get();

      if(count($validacion)  > 0 )
      {
          return redirect('/Materia')->with('status',
           "¡ El valor ".$request->Nombre." ya tiene un similar en el sistema !");
      }
      public function create (Request $request){
        $tipos_propiedad_materia= new TipoPropiedadMateria();
        $tipos_propiedad_materia->nombre = $request->Nombre;
        $tipos_propiedad_materia->save();
        return redirect('/Materia')->with('status', "!creado!");


  }

      public function edit ($id)  {
          $tipos_propiedad_materiaE = TipoPropiedadMateria::find($id);
          return response()->json(compact("tipos_propiedad_materiaE"));

      }

        public function update(Request $request, $id )
        {

          $sql = "Select * from TipoPropiedadMateria where nombre like '%".$request->Nombre."%'";
          $validation = DB::SELECT(DB::RAW($sql));

            if(count($validation) == 1)
            {
              if($id==$validation[0]->id)
              {
                return redirect('/Materia')->with('status',
                "¡ El valor ".$request->Nombre." ya se ha actualizado!");
              }
              else{
                return redirect('/Materia')->with('status',
                "¡ El valor ".$request->Nombre." ya tiene uno similar en el sistema!");
              }
            }
          $tipos_propiedad_materiaE = TipoPropiedadMateria::find($id);
          $tipos_propiedad_materiaE->nombre = $request->Nombre;
          $tipos_propiedad_materiaE->save();
          return redirect('/Materia')->with('status', "¡Usuario editado!");

        }

        public function delete ($id)
        {
            $propiedad_materiaE = TipoPropiedadMateria::find($id);
            $propiedad_materiaE->delete();
            return redirect('/Materia')->with('status', "¡usuario eliminado!");
        }
}
