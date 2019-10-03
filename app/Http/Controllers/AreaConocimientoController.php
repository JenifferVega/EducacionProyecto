<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AreaConocimientos;
use DB;

class AreaConocimientoController extends Controller
{

      public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
      }

      public function create (Request $request){

          $validacion = AreaConocimientos::where("nombre","like","%".$request->Nombre."%")->get();

          if(count($validacion)  > 0 )
          {
              return redirect('/ParaMet')->with('status',
               "¡ El valor ".$request->Nombre." ya tiene un similar en el sistema !");
          }

          $areas_conocimiento = new AreaConocimientos();
          $areas_conocimiento->nombre = $request->Nombre;
        //  print_r ($_REQUEST);
          $areas_conocimiento->save();
          return redirect('/ParaMet')->with('status', "¡Area de Conocimiento creado!");
      }


      public function edit ($id)  {
          $areas_conocimientoE = AreaConocimientos::find($id);
          return response()->json(compact("areas_conocimientoE"));

      }

      public function update(Request $request, $id )
      {

            $sql = "Select * from areas_conocimiento where nombre like '%".$request->Nombre."%'";
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

          $areas_conocimientoE = AreaConocimientos::find($id);
          $areas_conocimientoE->nombre = $request->Nombre;
          $areas_conocimientoE->save();
          return redirect('/ParaMet')->with('status', "¡Area de Conocimiento editado!");

      }
      public function Delete ($id){
          $areas_conocimientoE = AreaConocimientos::find($id);
          $areas_conocimientoE->delete();
          return redirect('/ParaMet')->with('status', "¡Area de Conocimiento eliminado!");
        }


      }
