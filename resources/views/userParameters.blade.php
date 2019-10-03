@extends("template.adminlte")

@section("header-menu")
<h1>
  Administrar Parámetros
  <small>Control</small>
</h1>
<ol class="breadcrumb">
  <li><a href="/test"><i class="fa fa-dashboard"></i> Home</a></li>
</ol>

@endsection


@section("content")


<div class="row">
     <div class="col-xs-12">
      <div class="col-lg-6 col-md-6">
       <div class="box">
         <div class="box-header">
           <h3 class="box-title">Tipos de Roles </h3>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
           <table id="example2" class="table table-bordered table-hover">
             <thead>
             <tr>
               <th>Id</th>
               <th>Nombre</th>
               <th>Opciones</th>

               </tr>
             </thead>
             <tbody>
               @foreach($roles as $rol )
                <tr>
                  <td>{{ $rol->id }}</td>
        					<td>{{ $rol->nombre }}</td>
                  <td>
                    <button class="btn btn-warning" onclick="editrole({{ $rol->id }})" > Editar </button>
                    <button class="btn btn-danger" onclick="confirmDelete( {{$rol->id}} ) "> Eliminar </button>
                  </td>
                </tr>
               @endforeach
             </tbody>
             <tfoot>
             <tr>
                 <th>Id</th>
                 <th>Nombre</th>
                 <th>opciones</th>


             </tr>
             </tfoot>
           </table>
           <html>
           <body>
           <button type="button" class="btn btn-primary" data-toggle="modal" onclick="creatrole()" data-target="#RoleFormModal">
             Crear Rol
           </button>
           </body>
           </html>


         </div>
         <!-- /.box-body -->
       </div>
     </div>
       <!-- /.box -->

     <div class="col-lg-6 col-md-6">
       <div class="box">
         <div class="box-header">
           <h3 class="box-title">Tipos de Documentos </h3>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
           <table id="example1" class="table table-bordered table-striped">
             <thead>
             <tr>
               <th>Id</th>
               <th>Nombres</th>
               <th>opciones</th>

             </tr>
             </thead>
             <tbody>
               @foreach($tiposDocumento as $tipodocument )
                <tr>
                  <td>{{ $tipodocument->id }}</td>
                  <td>{{ $tipodocument->nombre }}</td>
                  <td>
                    <button class="btn btn-warning"  onclick="editDocumento({{ $tipodocument->id }})"> Editar </button>
                    <button class="btn btn-danger"   onclick="comfiDelete( {{$tipodocument->id}} )" > Eliminar </button>

                  </td>
                </tr>
               @endforeach
             </tbody>
               <tfoot>
             <tr>
               <th>Id</th>
               <th>Nombres</th>
               <th>opciones</th>

            </tr>
             </tfoot>

           </table>
           <!-- Button trigger modal -->
           <button type="button" class="btn btn-primary" data-toggle="modal" onclick="creatDocumento()" data-target="#DocumentoFormModal">
             Crear Documento
           </button>
         </div>
         <!-- /.box-body -->
       </div>
       <!-- /.box -->
     </div>
   </div>
     <!-- /.col -->
   </div>

   <!-- Button trigger modal -->


   <!-- Modal -->
   <div class="modal fade" id="RoleFormModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Datos</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="RoleForm" action='/createrole' method="post">
              	{{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="Nombre">Nombre</label>
                  <input type="text" class="form-control" name="Nombre" id="Nombre" placeholder="Introducir Nombre">
                </div>


              <div class="box-footer">
                <button type="submit" class="btn btn-primary ">Enviar</button>
                <!-- /.box-body -->
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
 </div>

   <!-- Button trigger modal -->

   <!-- Modal -->
   <div class="modal fade" id="DocumentoFormModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <h3 class="box-title">Tipos de documentos</h3>
            </div>

            <!-- /.box-header -->
            <!-- form start -->
            <form tipoDocumento="form" id="DocumentoForm" action='/createDocumento' method="post">
                {{ csrf_field() }}

              <div class="box-body">
                <div class="form-group">
                  <label for="Nombr">Nombre</label>
                  <input type="text" class="form-control" name="Nombre" id="Nombr" placeholder="Introducir Nombre">
                </div>
                </div>


              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary ">Enviar</button>
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
    $(function () {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      })
    })
});
  function editrole(id)
  {
    $.get("/editrole/"+ id , function (response ){
      console.log (response) ;
      $("#Nombre").val(response.roleE.nombre);
      $("#RoleForm").attr("action", "/updateRole/" + id);
      $("#RoleFormModal").modal("show");
    })
    //alert ("id a editar "+id);
   }

   function creatrole() {
     if($("#RoleForm").attr("action") != "/createrole" )
     {
       $("#RoleForm").attr("action", "/createrole");
       $("#Nombre").val("");
     }
     else{
       console.log("no ejecuto");
     }
   }

   function confirmDelete(id)
   {
     if(window.confirm("¿Esta seguro de eliminar?"))
     {
       window.location = "/deleterole/"+id;
     }
   }
   function editDocumento(id)
   {
     $.get("/editDocumento/"+ id , function (response ){
       console.log (response) ;
       $("#Nombr").val(response.TipoDocumentoE.nombre);
       $("#DocumentoForm").attr("action", "/updateDocumento/" + id);
       $("#DocumentoFormModal").modal("show");
     })
   }

     function creatDocumento() {
       if($("#DocumentoForm").attr("action") != "/createDocumento" )
       {
         $("#DocumentoForm").attr("action", "/createDocumento");
         $("#Nombr").val("");
       }
       else{
         console.log("no ejecuto");
       }
     }


     function comfiDelete (id)
     {
       if(window.confirm("¿Esta seguro de eliminar?"))
       {
         window.location = "/DeleteDocumento/"+id;
       }
     }

</script>
@endsection
