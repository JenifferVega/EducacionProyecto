<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\tipoDocumento;
use DB;

class tipoDocumentoController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
    $this->middleware('admin');
  }

    public function create (Request $request){
      $validacion = tipoDocumento::where("nombre","like","%".$request->Nombre."%")->get();

      if(count($validacion)  > 0 )
      {
          return redirect('/parameters')->with('status',
           "¡ El valor ".$request->Nombre." ya tiene un similar en el sistema !");
      }


    $TipoDocumento = new tipoDocumento();
    $TipoDocumento->nombre = $request->Nombre;
  //  print_r ($_REQUEST);
    $TipoDocumento->save();
    return redirect('/parameters')->with('status', "!Documento creado!");

      }

    public function edit ($id)  {
        $TipoDocumentoE = tipoDocumento::find($id);
        return response()->json(compact("TipoDocumentoE"));

    }

      public function update(Request $request, $id )
      {
        //$validacion = Roles::where("nombre","like","%".$request->Nombre."%")->get();
      //  echo count ($validation);
      //   exit;

        $sql = "Select * from tipos_documento where nombre like '%".$request->Nombre."%'";
        $validation = DB::SELECT(DB::RAW($sql));
        //print_r($validation[0]);
      //  print_r (count($validation));


          if(count($validation) == 1)
          {
            if($id==$validation[0]->id)
            {
              return redirect('/parameters')->with('status',
              "¡ El valor ".$request->Nombre." ya se ha actualizado!");
            }
            else{
              return redirect('/parameters')->with('status',
              "¡ El valor ".$request->Nombre." ya tiene uno similar en el sistema!");
            }
          }

          $TipoDocumentoE = tipoDocumento::find($id);
          $TipoDocumentoE->nombre = $request->Nombre;
          $TipoDocumentoE->save();
          return redirect('/parameters')->with('status', "¡Documento editado!");

    }

        public function Delete ($id){
        $TipoDocumentoE = tipoDocumento::find($id);
        $TipoDocumentoE->delete();
        return redirect('/parameters')->with('status', "¡Documento eliminado!");
        }

    }
