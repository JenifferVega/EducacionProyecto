<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuarios;
use App\Roles;
use App\tipoDocumento;
use App\credencial;
use App\Grados;
use App\EstudianteGrado;
use DB;


class UserController extends Controller
{
      public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
      }

      public function index()
      {

        $usuarios = Usuarios::All();
        $usuariosArray = Usuarios::pluck("nombre","id");
        $rolesArray = Roles::pluck("nombre","id");
        $roles = Roles::All();
        $tiposDocumento = tipoDocumento::All();
        $tiposDocumentoArray = tipoDocumento::pluck("nombre","id");
        $credenciales = DB::SELECT(DB::RAW("select g.* ,  CONCAT(nombre,' ', apellido) as usunombre
        from usuarios as u inner join credenciales as g on u.id = g.usuario"));
        $grados = Grados::All();

        return view("usersManagement",compact('usuarios',"roles","tiposDocumento",
        "rolesArray","tiposDocumentoArray","credenciales","usuariosArray","grados"));
      }

      public function create (Request $request){


        $usuarios = new Usuarios();
        $usuarios->nombre = $request->Nombre;
        $usuarios->apellido = $request->Apellido;
      	$usuarios->direccion = $request->Dirección;
      	$usuarios->telefono = $request->Telefono;
      	$usuarios->tipo_documento = $request->TipodeDocumento;
      	$usuarios->numero_documento = $request->NumerodeDocumento;
      	$usuarios->rol = $request->Rol;

      	      // print_r ($_REQUEST);
        $usuarios->save();

        if($request->grado)
        {
          $gradoEstudiante  = new  EstudianteGrado();
          $gradoEstudiante->estudiante = $usuarios->id;
          $gradoEstudiante->grado = $request->grado;
          $gradoEstudiante->save();
        }

        return redirect('/users')->with('status', "¡Usuario creado!");

      }


      public function edit ($id)  {
          //$usuariosE = Usuarios::find($id);
          $usuariosE = DB::SELECT(DB::RAW("select u.* , g.grado from usuarios as u
           left join estudianteGrado as g on u.id = g.estudiante  WHERE u.id = ".$id))[0];


          return response()->json(compact("usuariosE"));
      }

      public function update(Request $request, $id )
      {
          $usuariosE = Usuarios::find($id);
          $usuariosE->nombre = $request->Nombre;
          $usuariosE->apellido = $request->Apellido;
        	$usuariosE->direccion = $request->Dirección;
        	$usuariosE->telefono = $request->Telefono;
        	$usuariosE->tipo_documento = $request->TipodeDocumento;
        	$usuariosE->numero_documento = $request->NumerodeDocumento;
        	$usuariosE->rol = $request->Rol;
          $usuariosE->save();

          if($request->grado)
          {
            $alreadyExist = EstudianteGrado::where("estudiante","=",$id)->first();
            if($alreadyExist)
            {
              if($alreadyExist->grado != $request->grado)
              {
                $gradoEstudiante  = EstudianteGrado::find($alreadyExist->id);
                $gradoEstudiante->estudiante = $id;
                $gradoEstudiante->grado = $request->grado;
                $gradoEstudiante->save();
              }
            }
            else{
              $gradoEstudiante  = new  EstudianteGrado();
              $gradoEstudiante->estudiante = $id;
              $gradoEstudiante->grado = $request->grado;
              $gradoEstudiante->save();
            }

          }

          return redirect('/users')->with('status', "¡Usuario editado!");

      }

      public function delete ($id)
      {
          $usuariosE = Usuarios::find($id);
          $usuariosE->delete();
          return redirect('/users')->with('status', "¡usuario eliminado!");
      }




}
