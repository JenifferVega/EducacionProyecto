@extends("template.adminlte")

@section("header-menu")
<h1>
  Administrar Parámetros

</h1>
<ol class="breadcrumb">
  <li><a href="/test"><i class="fa fa-dashboard"></i> Home</a></li>
</ol>

@endsection


@section("content")


<div class="row">
     <div class="col-xs-12">
      <div class="col-lg-12 col-md-12">
       <div class="box">
         <div class="box-header">
           <h3 class="box-title">Materias </h3>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
           <table class="table table-bordered table-hover datable">
             <thead>
             <tr>
               <th>Id</th>
               <th>area_conocimiento</th>
               <th>grado</th>
               <th>profesores</th>
               <th>nombre</th>
               <th>Opciones</th>

               </tr>
             </thead>
             <tbody>
               @foreach($materia as $materi )
                <tr>
                  <td>{{ $materi->id }}</td>
        					<td>{{ $materi->area_conocimiento }}</td>
                  <td>{{ $materi->grado }}</td>
                  <td>{{ $materi->profesor }}</td>
                  <td>{{ $materi->nombre }}</td>
                  <td style="text-align:center">
                    <button class="btn btn-warning" onclick="editmateri({{$materi->id}})" > Editar </button>
                    @if(App\usuarios::find(Auth::user()->usuario)->rol==1)
                      <button class="btn btn-danger" onclick="confirmDelete({{$materi->id}}) "> Eliminar </button>
                    @endif
                  </td>
                </tr>
               @endforeach
             </tbody>
             <tfoot>
             <tr>
                 <th>Id</th>
                 <th>area_conocimiento</th>
                 <th>grado</th>
                 <th>profesores</th>
                 <th>nombre</th>
                 <th>opciones</th>


             </tr>
             </tfoot>
           </table>
           <html>
           <body>
           <button type="button" class="btn btn-primary" data-toggle="modal" onclick="creatmateri()" data-target="#MateriaFormModal">
             Crear Materia
           </button>
           </body>
           </html>


         </div>
         <!-- /.box-body -->
       </div>
     </div>


     <div class="col-lg-12 col-md-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Notas </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered table-hover datable">
            <thead>
            <tr>
              <th>Id</th>
              <th>Logro</th>
              <th>Calificacion</th>
              <th>Periodo</th>
              <th>Estudiante</th>
              <th>Fecha</th>
              <th>Opciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($notas as $nota )
               <tr>
                 <td>{{ $nota->id }}</td>
                 <td>{{ $nota->logro }}</td>
                 <td>{{ $nota->calificacion }}</td>
                 <td>{{ $nota->periodo}}</td>
                 <td>{{ $nota->estudiante }}</td>
                 <td>{{ $nota->created_at }}</td>

                 <td>
                   <button class="btn btn-warning" onclick="editNota({{ $nota->id }})" > Editar </button>
                   <button class="btn btn-danger" onclick="confirDelete( {{$nota->id}} ) "> Eliminar </button>
                 </td>
               </tr>
              @endforeach
            </tbody>
            <tfoot>
            <tr>
              <th>Id</th>
              <th>Logro</th>
              <th>Calificacion</th>
              <th>Periodo</th>
              <th>Estudiante</th>
              <th>Fecha</th>
              <th>Opciones</th>
            </tr>
            </tfoot>
          </table>
          <html>
          <body>
          <button type="button" class="btn btn-primary" data-toggle="modal" onclick="creatNota()" data-target="#NotaFormModal">
            Crear Nota
          </button>
          </body>
          </html>


        </div>
        <!-- /.box-body -->
      </div>
    </div>

   </div>
 </div>

   <!-- Button trigger modal -->


      <!-- Modal  -->
      <div class="modal fade" id="MateriaFormModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                 <h3 class="box-title"></h3>
               </div>
               <!-- /.box-header -->
               <!-- form start -->
               <form role="form" id="MateriaForm" action='/createmateria' method="post">
                 	{{ csrf_field() }}
                 <div class="box-body">
                   <div class="form-group">
                     <label for="Tipo de Documento">Area de conocimiento</label>
                     <select class="form-control" name="Area_conocimiento" id="Area_conocimiento" required>
                       <option value="" >Selecciona</option>
                         @foreach($areas_conocimiento as $areasconocimient )
                       <option value="{{ $areasconocimient->id }}" >{{ $areasconocimient->nombre }}</option>
                       @endforeach
                       </select>
                   </div>


                   <div class="form-group">
                     <label for="Grados">Grados</label>
                     <select class="form-control" name="Grados" id="Grado" required>
                       <option value="" >Selecciona</option>
                         @foreach($grados as $grado )
                       <option value="{{ $grado->id }}" >{{ $grado->nombre }}</option>
                       @endforeach
                       </select>
                   </div>


                   <div class="form-group">
                     <label for="Profesor">Profesor</label>
                     <select class="form-control" name="Profesor" id="Profesor" required>
                       <option value="" >Selecciona</option>
                         @foreach($profesores as $profesor )
                       <option value="{{ $profesor->id }}" >{{ $profesor->nombre }} {{ $profesor->apellido }}</option>
                       @endforeach
                       </select>
                   </div>
                   <div class="form-group">
                     <label for="Nombre">Nombre</label>
                     <input type="text" class="form-control" name="Nombre" id="Nombre" placeholder="Nombre" required>
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


     <!-- Modal  -->
     <div class="modal fade" id="NotaFormModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h3 class="box-title"></h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->

              <form role="form" id="NotaForm" action='/createNota' method="post">
                 {{ csrf_field() }}
                <div class="box-body">
                  <div class="form-group">
                    <label for="Calificacion">Calificacion</label>
                    <input type="number" class="form-control" name="Calificacion" id="Calificacion" placeholder="Introducir Nombre" required>
                  </div>

                  <div class="form-group">
                  <label for="Logro">Logro</label>
                    <select class="form-control" name="logro" id="logro" required>
                      <option value="" >Selecciona</option>
                        @foreach($logros as $logro )
                         <option value="{{ $logro->id }}" >{{ $logro->logro }}</option>
                      @endforeach
                      </select>
                  </div>


                  <div class="form-group">
                    <label for="Periodo">Periodo</label>
                    <select class="form-control" name="Periodo" id="Periodo" required>
                      <option value="" >Selecciona</option>
                       @foreach($periodo as $period )
                         <option value="{{ $period->id }}" >{{ $period->nombre }}</option>
                      @endforeach
                      </select>
                  </div>


                  <div class="form-group">
                      <label for="Estudiante ">Estudiante </label>
                    <select class="form-control" name="Estudiante" id="Estudiante" required>
                      <option value="" >Selecciona</option>
                       @foreach($estudiante as $estudiant )
                         <option value="{{ $estudiant->id }}" >{{ $estudiant->nombre }} {{ $estudiant->apellido }}</option>
                      @endforeach
                      </select>
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
  function editmateri(id)
  {
    $.get("/editmateri/"+ id , function (response ){
      console.log (response) ;
      $("#Area_conocimiento").val(response.materiaE.area_conocimiento);
      $("#Grado").val(response.materiaE.grado);
      $("#Profesor").val(response.materiaE.profesor);
      $("#Nombre").val(response.materiaE.nombre);
      $("#MateriaForm").attr("action", "/updateMateri/" + id);
      $("#MateriaFormModal").modal("show");
    })
    //alert ("id a editar "+id);
   }

   function creatmateri() {
     if($("#MateriaForm").attr("action") != "/createmateria" )
     {
       $("#MateriaForm").attr("action", "/createmateria");
       $("#Area_conocimiento").val("");
       $("#Grado").val("");
       $("#Profesor").val("");
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
       window.location = "/deleteMateria/"+id;
     }
   }


   function editNota(id)
      {
     $.get("/editNota/"+ id , function (response ){
       console.log (response) ;
       $("#Materia").val(response.notasE.materia);
       $("#Calificacion").val(response.notasE.calificacion);
       $("#Periodo").val(response.notasE.periodo);
       $("#Estudiante").val(response.notasE.estudiante);
       $("#NotaForm").attr("action", "/updateNota/" + id);
       $("#NotaFormModal").modal("show");
     })
     //alert ("id a editar "+id);
    }

    function creatNota() {
      if($("#NotaForm").attr("action") != "/createNota" )
      {
        $("#NotaForm").attr("action", "/createNota");
        $("#Materia").val("");
        $("#Calificacion").val("");
        $("#Periodo").val("");
        $("#Estudiante").val("");
      }
      else{
        console.log("no ejecuto");
      }
    }

    function confirDelete(id)
    {
      if(window.confirm("¿Esta seguro de eliminar?"))
      {
        window.location = "/deleteNota/"+id;
      }
    }

</script>
@endsection
