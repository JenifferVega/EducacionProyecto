<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Roles;
use App\tipoDocumento;
use DB;

class RoleController extends Controller
{
  public function index()
  {
		$roles = Roles::All();

    $tiposDocumento = tipoDocumento::All();

    return view("userParameters",compact('roles','tiposDocumento'));
  }

    public function create (Request $request){
      //$sql = "Select * from roles where nombre like '%".$request->Nombre."%'";
      //echo $sql;
      //$validation = DB::SELECT(DB::RAW($sql));
      //print_r($validation);
      $validacion = Roles::where("nombre","like","%".$request->Nombre."%")->get();

      if(count($validacion)  > 0 )
      {
          return redirect('/parameters')->with('status',
           "¡ El valor ".$request->Nombre." ya tiene un similar en el sistema !");
      }

      $role = new Roles();
    	$role->nombre = $request->Nombre;
          //  print_r ($_REQUEST);
      $role->save();
      return redirect('/parameters')->with('status', "¡Rol creado!");

    }

    public function edit ($id)  {

        $roleE = Roles::find($id);
        return response()->json(compact("roleE"));

    }



    public function update(Request $request,  $id )
    {
      //$validacion = Roles::where("nombre","like","%".$request->Nombre."%")->get();

    //  echo count ($validacion);
      //exit;
      $sql = "Select * from roles where nombre like '%".$request->Nombre."%'";
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

        $roleE = Roles::find($id);
        $roleE->nombre = $request->Nombre;
        $roleE->save();
        return redirect('/parameters')->with('status', "¡Rol Editado!");

    }

    public function delete ($id){
      $roleE = Roles::find($id);
      $roleE->delete();
      return redirect('/parameters')->with('status', "¡usuario eliminado!");
  }

}
