@extends("template.adminlte")

@section("header-menu")
<h1>
  Administración de Usuarios
  <small>Control</small>
</h1>
<ol class="breadcrumb">
  <li><a href="/test"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Usuarios</li>
</ol>

@endsection

@section("content")

<div class="row">
     <div class="col-xs-12">
       <div class="box">
         <div class="box-header">
           <h3 class="box-title">Datos de los usuarios </h3>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
           <table  class="table table-bordered table-hover datable">
             <thead>
             <tr>
               <th>Id</th>
               <th>Nombre</th>
               <th>Apellido</th>
               <th>Dirección</th>
               <th>Teléfono</th>
               <th>Tipo de Documento</th>
               <th>Número de Documento</th>
               <th>Rol</th>
               <th>Opciones</th>
             </tr>
             </thead>
             <tbody>
                @foreach($usuarios as $usuario )
                <tr>
                  <td>{{ $usuario->id }}</td>
        					<td>{{ $usuario->nombre }}</td>
                  <td>{{ $usuario->apellido }}</td>
                  <td>{{ $usuario->direccion }}</td>
        					<td>{{ $usuario->telefono }}</td>
                  <td>{{ $tiposDocumentoArray[$usuario->tipo_documento] }}</td>
        					<td>{{ $usuario->numero_documento }}</td>
                  <td>{{ $rolesArray[$usuario->rol] }}</td>
                  <td style="text-align:center;">
                    <button class="btn btn-warning" onclick="editusuario({{ $usuario->id }})" > Editar </button>
                    <button class="btn btn-danger" onclick="confirmDelete({{ $usuario->id }})"> Eliminar </button>
                  </td>
                </tr>
               @endforeach

             </tbody>
             <tfoot>
             <tr>
               <th>Id</th>
               <th>Nombre</th>
               <th>Apellido</th>
               <th>Dirección</th>
               <th>Teléfono</th>
               <th>Tipo de Documento</th>
               <th>Número de Documento</th>
               <th>Rol</th>
               <th>Opciones</th>
             </tr>
             </tfoot>
           </table>
           <button type="button" class="btn btn-primary" data-toggle="modal" onclick="creauser()" data-target="#UserFormModal">
             Crear Usuario
           </button>
         </div>
         <!-- /.box-body -->
       </div>
       <!-- /.box -->

       <div class="box">
         <div class="box-header">
           <h3 class="box-title">Datos de las credenciales de los usuarios</h3>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
           <table  class="table table-bordered table-striped datable">
             <thead>
             <tr>
               <th>Id</th>
               <th>username</th>
               <th>fecha</th>
               <th>usuario</th>
               <th>Opciones</th>

             </tr>
             </thead>
             <tbody>
                 @foreach($credenciales as $credencial )
                   <tr>
                    <td>{{ $credencial->id }}</td>
                    <td>{{ $credencial->username }}</td>
                    <td>{{ $credencial->created_at  }}</td>
                    <td>{{ $credencial->usunombre}}</td>

                    <td style="text-align:center;">
                      <button class="btn btn-warning" onclick="editcredencial({{ $credencial->id }})"> Editar </button>
                      <button class="btn btn-danger"  onclick="confirDelete({{ $credencial->id }})"> Eliminar </button>

                    </td>
                  </tr>
                 @endforeach
             </tbody>
               <tfoot>
             <tr>
               <th>Id</th>
               <th>username</th>
               <th>Fecha</th>
               <th>usuario</th>
              <th>Opciones</th>

            </tr>
             </tfoot>

           </table>
           <!-- Button trigger modal -->
           <button type="button" class="btn btn-primary" data-toggle="modal" onclick="creatcredencial() "data-target="#CredentialsFormModal ",
        value="checkPassword" onclick="checkPassword()"  >
             Crear Credenciales
           </button>
         </div>
         <!-- /.box-body -->
       </div>
       <!-- /.box -->
     </div>
     <!-- /.col -->
   </div>

   <!-- Button trigger modal -->


   <!-- Modal -->
   <div class="modal fade" id="UserFormModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel"></h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Creación / edición de Usuario</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="UserForm" action='/createuser' method="post">
                {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="Nombre">Nombre</label>
                  <input type="text" class="form-control" name="Nombre" id="Nombre" placeholder="Introducir Nombre" required>
                </div>
                <div class="form-group">
                  <label for="Apellido">Apellido</label>
                  <input type="text" class="form-control" name="Apellido" id="Apellido" placeholder="Apellido" required>
                </div>
                <div class="form-group">
                  <label for="Dirección">Dirección</label>
                  <input type="text" class="form-control" name="Dirección" id="Dirección" placeholder="Dirección" required>
                </div>

                <div class="form-group">
                  <label for="Telefono">Teléfono</label>
                  <input type="number" class="form-control" name="Telefono" id="Telefono" placeholder="Teléfono" required>
                </div>
                <div class="form-group">
                  <label for="Tipo de Documento">Tipo de Documento</label>
                  <select class="form-control" name="TipodeDocumento" id="TipodeDocumento" required>
                    <option value="" >Selecciona</option>
                      @foreach($tiposDocumento as $tipodocument )
                    <option value="{{ $tipodocument->id }}" >{{ $tipodocument->nombre }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                  <label for="Número de Documento">Número de Documento</label>
                  <input type="text" class="form-control" name="NumerodeDocumento" id="NumerodeDocumento" placeholder="Documento" required>
                </div>
                <div class="form-group">
                  <label for="Rol">Rol</label>
                  <select class="form-control" name="Rol"   onchange="getUserRole()" id="Rol" required>
                    <option value="" >Selecciona</option>
                    	@foreach($roles as $rol )
                    <option value="{{ $rol->id }}" >{{ $rol->nombre }}</option>
                    @endforeach
                    </select>
                </div>

              


              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary form-control">Enviar</button>
              </div>
            </form>
          </div>

         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
         </div>
       </div>
     </div>
   </div>

   <!-- Button trigger modal -->

   <!-- Modal -->
   <div class="modal fade" id="CredentialsFormModal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel"></h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Datos de credenciales</h3>
            </div>

            <!-- /.box-header -->
            <!-- form start -->
            <form name="f" role="form" id="credencialForm" action='/createcredencial' method="post">
                {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="Username">Username</label>
                  <input type="text" class="form-control" name="Username" id="Username" placeholder="Username" required>
                </div>
                <div class="form-group">
                  <label for="usuario">Usuario</label>
                  <select class="js-example-basic-single"  name="Usuario" id="Usuario"   style="" required >
                    <option value ="" >Selecciona </option  >
                      @foreach($usuarios as $usuario )
                    <option value="{{ $usuario->id }}" >{{ $usuario->nombre }} {{ $usuario->apellido }}</option>
                    @endforeach
                  </select>
                </div>


                <div class="form-group">
                  <label for="Contraseña">Contraseña</label>
                  <input type="password" class="form-control" name="password1" id="password" placeholder="password" required>
                </div>

                 <!-- To Confirm Password. -->
                <div class="form-group">
                  <label for="Contraseña">Confirmar Contraseña</label>
                  <input type="password" class="form-control" name="password2" id="password" placeholder="password"required>
                </div>
              </div>

              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary form-control"  value="checkPassword" onclick="checkPassword()">Enviar</button>
              </div>
            </form>
          </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
       </div>
     </div>
   </div>

@endsection

@section("script")

<script>
$( document ).ready(function() {
    console.log( "ready!" );

    $('.datable').DataTable({
       "language": {
         "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
       }
     });


     $("#conditional-student").hide();


    $('.js-example-basic-single').select2({
      placeholder: 'Escribe la opción',
      allowClear: true,
      theme: "bootstrap"
    });


});

function creauser(){
  $("#conditional-student").hide();
}


function editusuario(id)
{
  $.get("/editusuario/"+ id , function (response ){
    console.log (response) ;

    if(response.usuariosE.rol == 3)
    {
      $("#conditional-student").show();
      $("#grado").val(response.usuariosE.grado);
    }
    else
    {
      $("#conditional-student").hide();
    }

    $("#Nombre").val(response.usuariosE.nombre);
    $("#Apellido").val(response.usuariosE.apellido);
    $("#Dirección").val(response.usuariosE.direccion);
    $("#Telefono").val(response.usuariosE.telefono);
    $("#TipodeDocumento").val(response.usuariosE.tipo_documento);
    $("#NumerodeDocumento").val(response.usuariosE.numero_documento);
    $("#Rol").val(response.usuariosE.rol);
    $("#UserForm").attr("action", "/updateUser/" + id);
    $("#UserFormModal").modal("show");
  })
  //alert ("id a editar "+id);
 }


     function creauser() {

       $("#UserForm").trigger("reset");

       if($("#UserForm").attr("action") != "/createuser" )
       {
         $("#UserForm").attr("action", "/createuser");
         $("#Nombre").val("");
       }
       else{
         console.log("no ejecuto");
       }
     }
  //alert ("id a editar "+id);
  function confirmDelete(id)
  {
    if(window.confirm("¿Esta seguro de eliminar?"))
    {
      window.location = "/deleteUser/"+id;
    }
  }

  function editcredencial(id)
  {
    $.get("/editcredencial/"+ id , function (response ){
      console.log (response) ;
      $("#Username").val(response.credencialesE.username);

      $("#Usuario").val(response.credencialesE.usuario);
      $("#password").val(response.credencialesE.password);
      $("#credencialForm").attr("action", "/updatecredencial/" + id);
      $("#CredentialsFormModal").modal("show");
    })
    //alert ("id a editar "+id);
   }

      function creatcredencial() {
        if($("#credencialForm").attr("action") != "/createcredencial" )
        {
          $("#credencialForm").attr("action", "/createcredencial");
          $("#Username").val("");
          $("#Usuario").val("");
          $("#password").val("");
          $("#password2").val("");
        }
        else{
          console.log("no ejecuto");
        }
      }



            function checkPassword(form) {
               password1 = f.password1.value;
               password2 = f.password2.value;

               // If password not entered
               if (password1 == '')
                   alert ("Please enter Password");

               // If confirm password not entered
               else if (password2 == '')
                   alert ("Please enter confirm password");

               // If Not same return False.
               else if (password1 != password2) {
                   alert ("\nLas contraseñas no coinciden intente denuevo!...")
                   return false;
               }

               // If same return True.
               else{
                   alert("Las contraseñas coinciden! se ha editado su usuario!")
                   return true;
               }

           }



      function confirDelete(id)
      {
        if(window.confirm("¿Esta seguro de eliminar?"))
        {
          window.location = "/deletecredential/"+id;
        }
      }

      function getUserRole()
      {
        console.log($('select[name="Rol"]').val());

        if($('select[name="Rol"]').val() == 3 )
        {
          $("#conditional-student").show();
        }
        else
        {
          $("#conditional-student").hide();
        }

      }

</script>
@endsection
