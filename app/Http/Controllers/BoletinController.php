<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grados;
use App\Materia;
use App\Periodos;
use App\Nota;
use App\AreaConocimientos;
use App\Logro;
use DB;

use App\propiedadeNota;

class BoletinController extends Controller
{

    public function __construct(){
      $this->middleware('auth');

      //Estos middleware son ejemplos para saber como se implementan
          //$this->middleware('auth', ['only' => ['create', 'store', 'edit', 'delete']]);
          // Alternativly
          //$this->middleware('auth', ['except' => ['index', 'show']]);

    }

    public function index ()
    {

      $areas_conocimientoArray = AreaConocimientos::pluck("nombre","id");
      $grados = Grados::All();
      $periodos = Periodos::All();
      return view("GestionarBoletin",compact('grados','periodos',"areas_conocimientoArray"));
    }

    public function filterCourse(Request $request)
    {
      $course = $request->course;
      $sql = "Select u.*,e.grado from usuarios as u inner join estudiantegrado as e
      on u.id = e.estudiante  where e.grado = '".$course."' ORDER BY u.nombre";
      $estudiantes = DB::SELECT(DB::RAW($sql));
      $grados = Grados::All();
      $periodos = Periodos::All();
      return view("GestionarBoletin",compact('grados',"estudiantes","course","periodos"));
    }

    public function OpenSee()
    {
      $propiedad_nota = propiedadeNota::All();
      return view("GestionarBoletin", compact("propiedad_nota"));
    }

    public function openScores(Request $request)
    {

      /*$sql = "select m.* , n.calificacion, n.estudiante from materia as m  left join
      notas as n on (n.estudiante = '".$request->estudiante."' and n.periodo = '".$request->periodo."'
      and n.materia = m.id) where m.grado = '".$request->grado."' ";

      $Materias = DB::SELECT(DB::RAW($sql));*/

      $Materias = Materia::where("grado","=",$request->grado)->orderBy("nombre")->get();

      return response()->json(compact("Materias"));
    }


    public function qachivements(Request $request)
    {
      $Logros = Logro::where("materia","=",$request->materia)->orderBy("logro")->get();

      return response()->json(compact("Logros"));
    }

    public function scoreStudent(Request $request)
    {
      $sql = "select * from notas where estudiante = '".$request->estudiante."'
       and materia = '".$request->materia."'  and periodo = '".$request->periodo."'
       and created_at like '%".date("Y")."%'";

       //echo $sql;

       $datos = DB::SELECT(DB::RAW($sql));

       if(count($datos) > 0)
       {
         $nota = Nota::find($datos[0]->id);
         $nota->materia = $request->materia;
         $nota->calificacion = $request->calificacion;
         $nota->periodo = $request->periodo;
         $nota->estudiante = $request->estudiante;
         //print_r($nota);

         $nota->save();
       }
       else
       {
         $nota = new Nota();
         $nota->materia = $request->materia;
         $nota->calificacion = $request->calificacion;
         $nota->periodo = $request->periodo;
         $nota->estudiante = $request->estudiante;
         $nota->save();
       }

    }


    public function generateExcel($id)
    {
      header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
      header("Content-Disposition: attachment; filename=boletin.xls");  //File name extension was wrong
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
      header("Cache-Control: private",false);
      echo view("boletinExcel");
    }

}
