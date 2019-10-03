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
      <div class="col-lg-12 col-md-12">
       <div class="box">
         <div class="box-header">
           <h3 class="box-title">Propiedades Materia </h3>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
           <table class="table table-bordered table-hover datable">
             <thead>
             <tr>
                   <th>Id</th>
                   <th>Codigo</th>
                   <th>Tipo_Propiedad</th>
                   <th>Logro</th>
                   <th>Observacion</th>
                   <th>Opciones</th>

               </tr>
             </thead>
             <tbody>
               @foreach($propiedad_materia as $propiedadmateri )
                <tr>
                  <td>{{ $propiedadmateri->id }}</td>
        					<td>{{ $propiedadmateri->codigo }}</td>
                  <td>{{ $propiedadmateri->tipo_propiedad}}</td>
        					<td>{{ $propiedadmateri->logro }}</td>
                  <td>{{ $propiedadmateri->observacion }}</td>
                  <td style="text-align:center">
                    <button class="btn btn-warning" onclick="editMat({{ $propiedadmateri->id }})" > Editar </button>
                    <button class="btn btn-danger" onclick="confirmDelete( {{$propiedadmateri->id}} ) "> Eliminar </button>
                  </td>
                </tr>
               @endforeach
             </tbody>
             <tfoot>
             <tr>
                 <th>Id</th>
                 <th>Codigo</th>
                 <th>Tipo_Propiedad</th>
                 <th>Logro</th>
                 <th>Observacion</th>
                 <th>Opciones</th>


             </tr>
             </tfoot>
           </table>


           <button type="button" class="btn btn-primary" data-toggle="modal" onclick="creatMat()" data-target="#MatFormModal">
             Crear Propiedad Materia
           </button>

         </div>
         <!-- /.box-body -->
       </div>
     </div>


<div class="row">
  <div class="col-xs-12">
     <div class="col-lg-12 col-md-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Logros</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered table-hover datable">
            <thead>
            <tr>
                <th>Id</th>
                <th>materia</th>
                <th>Logro</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
              @foreach($logros as $logro )
               <tr>
                 <td>{{ $logro->id }}</td>
       				   <td>{{ $logro->materia }}</td>
                 <td>{{ $logro->logro}}</td>
                 <td style="text-align:center">
                   <button class="btn btn-warning" onclick="editlogro({{ $logro->id }})" > Editar </button>
                   <button class="btn btn-danger" onclick="confDelete( {{$logro->id}} ) "> Eliminar </button>
                 </td>
               </tr>
              @endforeach
            </tbody>
            <tfoot>
            <tr>

              <th>Id</th>
              <th>materia</th>
              <th>Logro</th>

            </tr>
            </tfoot>
          </table>


          <button type="button" class="btn btn-primary" data-toggle="modal" onclick="creatlogro()" data-target="#logroFormModal">
            Crear Logro
          </button>

        </div>
        <!-- /.box-body -->
      </div>
    </div>

       <!-- /.box -->


         <!--     <div class="col-lg-12 col-md-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Propiedades de las Notas</h3>
                </div>

                <div class="box-body">
                  <table  class="table table-bordered table-striped datable">
                    <thead>
                    <tr>
                      <th>Id</th>
                      <th>nota</th>
                      <th>Nota_superior</th>
                      <th>Propiedad</th>
                      <th>opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($propiedad_nota as $propiedadnota )
                       <tr>
                         <td>{{ $propiedadnota->id }}</td>
                         <td>{{ $propiedadnota->nota}}</td>
                         <td>{{ $propiedadnota->nota_superior }}</td>
                         <td>{{ $propiedadnota->propiedad }}</td>
                         <td style="text-align:center">
                           <button class="btn btn-warning" onclick="editNot({{ $propiedadnota->id }})" > Editar </button>
                           <button class="btn btn-danger"  onclick="confirDelete( {{$propiedadnota->id }} ) "> Eliminar </button>
                         </td>
                       </tr>
                      @endforeach
                    </tbody>
                      <tfoot>
                    <tr>
                      <th>Id</th>
                      <th>Nota</th>
                      <th>nota_superior</th>
                      <th>Propiedad</th>
                      <th>opciones<th>
                   </tr>
                    </tfoot>

                  </table>
                   Button trigger modal
                  <button type="button" class="btn btn-primary" data-toggle="modal" onclick="creatNot()" data-target="#NotFormModal">
                    Crear propiedades de Notas
                  </button>
                </div>
                </.box-body
              </div>
               /.box
            </div> -->



            <!--
        <div class="col-lg-6 col-md-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tipos Propiedades de las Materias</h3>
            </div>

            <div class="box-body">
              <table  class="table table-bordered table-striped datable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Opciones</th>

                  </tr>
                </thead>
                <tbody>
                  @foreach($tipos_propiedad_materia as $tipos_propiedad_materi )
                   <tr>
                     <td>{{ $tipos_propiedad_materi->id }}</td>
                     <td>{{ $tipos_propiedad_materi->nombre }}</td>
                     <td style="text-align:center">
                       <button class="btn btn-warning" onclick="editProp({{ $tipos_propiedad_materi->id }})" > Editar </button>
                       <button class="btn btn-danger"  onclick="cofiDelete( {{$tipos_propiedad_materi->id }} ) "> Eliminar </button>
                     </td>
                   </tr>
                  @endforeach
                </tbody>
                <tfoot>
                    <tr>
                      <th>Id</th>
                      <th>Nombre</th>
                      <th>Opciones</th>
                   </tr>
               </tfoot>

              </table>

              <button type="button" class="btn btn-primary" data-toggle="modal" onclick="creatProp()" data-target="#PropFormModal">
                Crear Tipo Propiedad Materia
              </button>
            </div>

          </div>

        </div>



   </div>

 </div>  -->

   <!-- Button trigger modal -->


   <!-- Modal -->
   <div class="modal fade" id="MatFormModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <form role="form" id="RoleMat" action='/createMat' method="post">
                  	{{ csrf_field() }}

                <div class="form-group">
                  <label for="codigo">codigo</label>
                  <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Introducir Nombre">
                </div>


                <div class="form-group">
                <label for="logro">Logro</label>
                 <select class="form-control" name="logro" id="logro">
                   <option value="" >Selecciona</option>
                     @foreach($logros as $logro )
                   <option value="{{ $logro->id }}" >{{ $logro->logro}}</option>
                   @endforeach
                   </select>
               </div>

                <div class="form-group">
                <label for="tipoPropiedad">tipoPropiedad</label>
                 <select class="form-control" name="tipo_Propiedad" id="tipo_Propiedad">
                   <option value="" >Selecciona</option>
                     @foreach($tipos_propiedad_materia as $tipos_propiedad_materi )
                   <option value="{{ $tipos_propiedad_materi->id }}" >{{ $tipos_propiedad_materi->nombre}}</option>
                   @endforeach
                   </select>
               </div>


                <div class="form-group">
                   <label for="observacion">observacion</label>
                   <input type="text" class="form-control" name="observacion" id="observacion" placeholder="Introducir Nombre">
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

    <!--eND -->
   <div class="modal fade" id="logroFormModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <form role="form" id="Rolelogro" action='/createlogro' method="post">
                    {{ csrf_field() }}
                <div class="form-group">
                <label for="materia">materia</label>
                 <select class="form-control" name="materia" id="materia">
                   <option value="" >Selecciona</option>
                     @foreach($materia as $materi )
                   <option value="{{ $materi->id }}" >{{ $materi->nombre}}</option>
                   @endforeach
                   </select>
               </div>

                <div class="form-group">
                  <label for="logro">logro</label>
                  <input type="text" class="form-control" name="logro" id="logro" placeholder="Introducir logro">
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


   <!-- Modal  notas
   <div class="modal fade" id="NotFormModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

            <form role="form" id="Notform" action='/createNot' method="post">
                {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="nota">nota</label>
                  <input type="number" class="form-control" name="nota" id="nota" placeholder="Introducir Nota">
                </div>

                <div class="form-group">
                  <label for="notaSuperior">notaSuperior</label>
                  <input type="number" class="form-control" name="notaSuperior" id="notaSuperior" placeholder="Introducir notaSuperior">
                </div>

                <div class="form-group">
                <label for="Propiedad">Propiedad</label>
                 <select class="form-control" name="propiedad" id="propiedad">
                   <option value="" >Selecciona</option>
                     @foreach($propiedad_materia as $propiedadmateri )
                   <option value="{{ $propiedadmateri->id }}" >{{ $propiedadmateri->codigo}}</option>
                   @endforeach
                   </select>
               </div>





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
  </div> -->




     <!--
     <div class="modal fade" id="PropFormModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                <form role="form" id="PropForm" action='/createProp' method="post">
                    	{{ csrf_field() }}

                  <div class="form-group">
                    <label for="nombre">nombre</label>
                    <input type="text" class="form-control" name="Nombre" id="Nombre" placeholder="Introducir Nombre">
                  </div>

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
     </div> -->




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
  function editMat(id)
  {
    $.get("/editMat/"+ id , function (response ){
      console.log (response) ;
      $("#codigo").val(response.propiedad_materiaE .codigo);
      $("#tipo_Propiedad").val(response.propiedad_materiaE .tipoPropiedad)
      $("#logro").val(response.propiedad_materiaE .logro)
      $("#observacion").val(response.propiedad_materiaE .observacion)
      $("#RoleMat").attr("action", "/updateMat/" + id);
      $("#MatFormModal").modal("show");
    })
    //alert ("id a editar "+id);
   }

   function creatMat() {
     if($("#RoleMat").attr("action") != "/createMat" )
     {
       $("#RoleMat").attr("action", "/createMat");
       $("#codigo").val("");
       $("#tipo_Propiedad").val("");
       $("#logro").val("");
       $("#observacion").val("");
     }
     else{
       console.log("no ejecuto");
     }
   }

   function confirmDelete(id)
   {
     if(window.confirm("¿Esta seguro de eliminar?"))
     {
       window.location = "/deleteMat/"+id;
     }
   }


   function editNot(id)
   {
     $.get("/editNot/"+ id , function (response ){
       console.log (response) ;
       $("#nota").val(response.propiedad_notaE .nota);
       $("#nota_superior").val(response.propiedad_notaE .notaSuperior);
       $("#propiedad").val(response.propiedad_notaE .propiedad);
       $("#Notform").attr("action", "/updateNot/" + id);
       $("#NotFormModal").modal("show");
     })
     //alert ("id a editar "+id);
    }


       function creatNot() {
         if($("#Notform").attr("action") != "/createNot" )
         {
           $("#Notform").attr("action", "/createNot");
           $("#Nota").val("");
         }
         else{
           console.log("no ejecuto");
         }
       }

       function confirDelete(id)
       {
         if(window.confirm("¿Esta seguro de eliminar?"))
         {
           window.location = "/deleteNot/"+id;
         }
       }


    function editProp(id)
    {
      $.get("/editProp/"+ id , function (response ){
        console.log (response) ;
        $("#Nombre").val(response.tipos_propiedad_materiaE .nombre);
        $("#PropForm").attr("action", "/updateProp/" + id);
        $("#PropFormModal").modal("show");
      })
      //alert ("id a editar "+id);
     }


        function creatProp() {
          if($("#PropForm").attr("action") != "/createProp" )
          {
            $("#PropForm").attr("action", "/createProp");
            $("#Nombre").val("");
          }
          else{
            console.log("no ejecuto");
          }
        }

        function cofiDelete(id)
        {
          if(window.confirm("¿Esta seguro de eliminar?"))
          {
            window.location = "/deleteProp/"+id;
          }
        }


    function editlogro(id)
    {
      $.get("/editlogro/"+ id , function (response ){
        console.log (response) ;
        $("#materia").val(response.logrosE.materia);
        $("#logro").val(response.logrosE.logro)
        $("#Rolelogro").attr("action", "/updatelogro/" + id);
        $("#logroFormModal").modal("show");
      })
      //alert ("id a editar "+id);
     }

     function creatlogro() {
       if($("#Rolelogro").attr("action") != "/createlogro" )
       {
         $("#Rolelogro").attr("action", "/createlogro");
         $("#materia").val("");
         $("#logro").val("");
       }
       else{
         console.log("no ejecuto");
       }
     }

     function confDelete(id)
     {
       if(window.confirm("¿Esta seguro de eliminar?"))
       {
         window.location = "/deletelogro/"+id;
       }
     }

</script>
@endsection
