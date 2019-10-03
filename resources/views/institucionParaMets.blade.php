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
           <h3 class="box-title"> Grados </h3>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
           <table class="table table-bordered table-hover datable">
             <thead>
             <tr>
               <th>Id</th>
               <th>Nombre</th>
               <th>Opciones</th>

               </tr>
             </thead>
             <tbody>
               @foreach($grados as $grado )
                <tr>
                  <td>{{ $grado->id }}</td>
        					<td>{{ $grado->nombre }}</td>
                  <td style="text-align:center;">
                    <button class="btn btn-warning" onclick="editgrado({{ $grado->id }})" > Editar </button>
                    <button class="btn btn-danger"  onclick="confirmDelete( {{$grado->id }} ) "> Eliminar </button>
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
           <button type="button" class="btn btn-primary" data-toggle="modal" onclick="creatgrado()" data-target="#GradoFormModal">
             Crear Grado
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
           <h3 class="box-title">Areas de Conocimiento</h3>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
           <table  class="table table-bordered table-striped datable">
             <thead>
             <tr>
               <th>Id</th>
               <th>Nombres</th>
               <th>opciones</th>

             </tr>
             </thead>
             <tbody>
               @foreach($areas_conocimiento as $areasconocimient )
                <tr>
                  <td>{{ $areasconocimient->id }}</td>
                  <td>{{ $areasconocimient->nombre }}</td>
                  <td style="text-align:center;">
                    <button class="btn btn-warning" onclick="editarea({{ $areasconocimient->id }})" > Editar </button>
                    <button class="btn btn-danger"  onclick="confirDelete( {{$areasconocimient->id }} ) "> Eliminar </button>
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
           <button type="button" class="btn btn-primary" data-toggle="modal" onclick="creatareas()" data-target="#AreasFormModal">
             Crear area de conocimiento
           </button>
         </div>
         <!-- /.box-body -->
       </div>
       <!-- /.box -->
     </div>

<div class="col-lg-6 col-md-6">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Periodo</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table  class="table table-bordered table-striped datable">
        <thead>
        <tr>
          <th>Id</th>
          <th>Nombres</th>
          <th>opciones</th>

        </tr>
        </thead>
        <tbody>
          @foreach($periodo as $period )
           <tr>
             <td>{{ $period->id }}</td>
             <td>{{ $period->nombre }}</td>
             <td style="text-align:center;">
               <button class="btn btn-warning" onclick="editperiodo({{ $period->id }})" > Editar </button>
               <button class="btn btn-danger"  onclick="confiDelete( {{$period->id }} ) "> Eliminar </button>
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
      <button type="button" class="btn btn-primary" data-toggle="modal" onclick="creatperiod()" data-target="#periodoFormModal">
        Crear Periodo
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
   <div class="modal fade" id="GradoFormModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Dato de Grados</h5>
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
            <form role="form" id="GradoForm" action='/creategrado' method="post">
              	{{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="Nombre">Nombre</label>
                  <input type="text" class="form-control" name="Nombre" id="Nombre" placeholder="Introducir Nombre">
                </div>

              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary form-control">Enviar</button>
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
   <div class="modal fade" id="AreasFormModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <h3 class="box-title">Areas de Conocimiento</h3>
            </div>

            <!-- /.box-header -->
            <!-- form start -->
            <form tipoDocumento="form" id="AreasForm" action='/createareas' method="post">
                {{ csrf_field() }}

              <div class="box-body">
                <div class="form-group">
                  <label for="Nombr">Nombr</label>
                  <input type="text" class="form-control" name="Nombre" id="Nombr" placeholder="Introducir Nombre">
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
   <div class="modal fade" id="periodoFormModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <h3 class="box-title">Periodo</h3>
            </div>

            <!-- /.box-header -->
            <!-- form start -->
            <form tipoDocumento="form" id="PeriodoForm" action='/createperiodo' method="post">
                {{ csrf_field() }}

              <div class="box-body">
                <div class="form-group">
                  <label for="Nombr">Nombr</label>
                  <input type="text" class="form-control" name="Nombre" id="Nomb" placeholder="Introducir Nombre">
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
});

  //---------------->Grados
  function editgrado(id)
  {
    $.get("/editgrado/"+ id , function (response ){
      console.log (response) ;
      $("#Nombre").val(response.gradosE.nombre);
      $("#GradoForm").attr("action", "/updategrado/" + id);
      $("#GradoFormModal").modal("show");
    })
    //alert ("id a editar "+id);
   }

   function  creatgrado() {
     if($("#GradoForm").attr("action") != "/creategrado" )
     {
       $("#GradoForm").attr("action", "/creategrado");
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
          window.location = "/deletegrado/"+id;
        }
      }

//-------------> areas de conocimiento

        function editarea(id)
        {
          $.get("/editarea/"+ id , function (response ){
            console.log (response) ;
            $("#Nombr").val(response.areas_conocimientoE.nombre);
            $("#AreasForm").attr("action", "/updatearea/" + id);
            $("#AreasFormModal").modal("show");
          })
          //alert ("id a editar "+id);
         }


            function   creatareas() {
              if($("#AreasForm").attr("action") != "/createareas" )
              {
                $("#AreasForm").attr("action", "/createareas");
                $("#Nombr").val("");
              }
              else{
                console.log("no ejecuto");
              }
            }


            function confirDelete(id)
            {
              if(window.confirm("¿Esta seguro de eliminar?"))
              {
                window.location = "/deletearea/"+id;
              }
            }

    //-------------------------------------periodo

    function editperiodo(id)
    {
      $.get("/editperiodo/"+ id , function (response ){
        console.log (response) ;
        $("#Nomb").val(response.periodoE.nombre);
        $("#PeriodoForm").attr("action", "/updateperiodo/" + id);
        $("#periodoFormModal").modal("show");
      })
      //alert ("id a editar "+id);
     }

     function   creatperiod() {
       if($("#PeriodoForm").attr("action") != "/createperiodo" )
       {
         $("#PeriodoForm").attr("action", "/createperiodo");
         $("#Nomb").val("");
       }
       else{
         console.log("no ejecuto");
       }
     }

     function confiDelete(id)
     {
       if(window.confirm("¿Esta seguro de eliminar?"))
       {
         window.location = "/deleteperiodo/"+id;
       }
     }



</script>
@endsection
