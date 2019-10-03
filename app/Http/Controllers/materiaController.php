<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materia;
use App\Grados;
use App\AreaConocimientos;
use App\Usuarios;
use App\Nota;
use App\periodos;
use App\Roles;
use App\logro;
use DB;

    class materiaController extends Controller
    {
      public function index()
      {
        //$materia = Materia::All();
        $materia = DB::SELECT(DB::RAW("select m.id ,m.nombre , a.nombre as area_conocimiento, concat(u.nombre,' ',u.apellido) as profesor, g.nombre as grado  from materia as m INNER JOIN areas_conocimiento as a
on m.area_conocimiento = a.id INNER JOIN usuarios as u on m.profesor = u.id INNER JOIN grados as g on m.grado = g.id;"));
        $grados = Grados::All();
        $gradosArray = Grados::pluck("nombre","id");
        $areas_conocimiento= AreaConocimientos::All();
        $areas_conocimientoArray = AreaConocimientos::pluck("nombre","id");
        $profesores = Usuarios::where("rol","=",2)->get();
        $notas= DB::SELECT(DB::RAW("select m.id, g.logro as logro, concat(u.nombre,' ',u.apellido) as estudiante , p.nombre as periodo ,m.calificacion, m.created_at from notas as m
 INNER JOIN logros as g on m.logro = g.id INNER JOIN usuarios as u on m.estudiante = u.id INNER JOIN periodo as p on m.periodo = p.id;"));
        $periodo = periodos::All();
        $logros = logro::All();
        $estudiante = Usuarios::where("rol","=",3)->get();


        return view("admonMaterias&NotasMath",compact('materia',"grados","gradosArray",
        "areas_conocimiento","areas_conocimientoArray","profesores","notas","periodo","estudiante","logros"));
      }

      public function create (Request $request){

        $materia = new Materia();
        $materia->area_conocimiento = $request->Area_conocimiento;
        $materia->grado = $request->Grados;
        $materia->profesor = $request->Profesor;
        $materia->nombre = $request->Nombre;
      //  print_r ($_REQUEST);
        $materia->save();
        return redirect('/Math')->with('status', "¡Grado creado!");

      }

      public function edit ($id)  {
          $materiaE = Materia::find($id);
          return response()->json(compact("materiaE"));
      }

      public function update(Request $request, $id )
      {
          $materiaE = Materia::find($id);
          $materiaE->area_conocimiento = $request->Area_conocimiento;
          $materiaE->grado = $request->Grados;
          $materiaE->profesor = $request->Profesor;
          $materiaE->nombre = $request->Nombre;
          $materiaE->save();
          return redirect('/Math')->with('status', "¡Grado editado!");

      }

      public function delete ($id){
          $materiaE = Materia::find($id);
          $materiaE->delete();
          return redirect('/Math')->with('status', "¡Grado eliminado!");
        }

    }
