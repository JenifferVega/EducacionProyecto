@extends("template.adminlte")

@section("header-menu")
<h1>
Gestionar Boletin

</h1>
<ol class="breadcrumb">
  <li><a href="/test"><i class="fa fa-dashboard"></i> Home</a></li>
</ol>

@endsection


@section("content")

<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Gestión de Boletin </h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <form  action="/filterCourses"  method="get">
          <div class="form-group">
            <label for="Boletin">Grados disponibles</label>
            <select class="form-control"  name="course" id="course"   style="" required >
              <option value ="" >Selecciona </option  >
                @foreach($grados as $grado )
              <option value="{{ $grado->id }}"  <?php if(isset($course)){
                if($course == $grado->id){
                  echo "selected";
                }
              }?>  >{{ $grado->nombre }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <button class="btn btn-danger form-control" >Buscar</button>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
      <!-- /.box-body -->
    @if(isset($estudiantes))
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Estudiantes</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-responsive datable" style="text-align:center" >
                  <thead>
                    <tr>
                      <th>Estudiante</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($estudiantes as $estudiante)
                    <tr>
                      <td> {{ $estudiante->nombre }} {{ $estudiante->apellido }} </td>
                      <td>
                        <button class="btn btn-success" onclick="openScores('{{$estudiante->id}}' ,'{{$estudiante->grado}}' )" >Ver notas</button>
                        <button class="btn btn-primary" onclick="generateExcel('{{$estudiante->id}}')" >Generar boletin</button>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
             </div>
            </div>
          </div>
        </div>
    @endif



    <div class="modal fade" id="ScoresModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Dato de Grados</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="col-lg-12 col-md-12">
              <div class="box">
                <!-- /.box-header -->
                <div class="box-body">

                  <select class="form-control" onchange="selectPeriod()" id="selectPeriod"  required>
                    <option value="" required>Selecciona el periodo</option>
                    @if(isset($periodos))
                      @foreach($periodos as $periodo)
                        <option value="{{ $periodo->id }}" >{{ $periodo->nombre }}</option>
                      @endforeach
                    @endif
                  </select>
                  <br>
                  <table  class="table table-bordered table-striped datable " id="thetable">
                    <thead>
                    <tr>
                      <th>Materia</th>
                      <th>Nota Ponderada</th>
                      <th>Calificar</th>

                    </tr>
                    </thead>
                    <tbody id="coursesData">

                       <tr>
                         <td></td>
                         <td></td>
                         <td></td>

                       </tr>

                    </tbody>

                  </table>
                </div>
              </div>
            </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="AchivementsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Logros</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="col-lg-12 col-md-12">
              <div class="box">
                <!-- /.box-header -->
                <div class="box-body">

                  <br>
                  <table  class="table table-bordered table-striped datable " style="text-align:center;" id="thetable">
                    <thead>
                    <tr>
                      <th>Logro</th>
                      <th>Nota Actual</th>
                      <th>Calificar</th>

                    </tr>
                    </thead>
                    <tbody id="achivementsData">

                       <tr>
                         <td></td>
                         <td></td>
                         <td></td>

                       </tr>

                    </tbody>

                  </table>
                </div>
              </div>
            </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>



    <!-- Modal -->
<div class="modal fade" id="qualificationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Calificar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="/scoreStudent" id="ScoreForm">
          {{ csrf_field() }}
          <input type="hidden" name="materia" id="materia"  value="" >

          <input type="hidden" name="estudiante" id="estudiante"  value="" >

          <input type="hidden" name="periodo" id="periodo"  value="" >

          <input type="hidden" name="grado" id="grado"  value="" >

          <div class="form-group">
            <label  for="Tipo de Documento">Calificar Logro</label>
          </div>

          <div class="form-group">
            <label  for="Tipo de Documento">Valor de la nota</label>

          </div>

          <div class="form-group">
            <button  class="btn btn-success form-control" >Calificar</button>
          </div>

        </form>


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



      $('.js-example-basic-single').select2({
        placeholder: 'Escribe la opción',
        allowClear: true,
        theme: "bootstrap"
      });




  });

  function openScores(id,grado)
  {
    $("#ScoresModal").modal("show");
    console.log(id);
    console.log(grado);
    $("#estudiante").val(id);
    $("#grado").val(grado);
    resetScoresTable();
  }

  function selectPeriod()
  {
    console.log("estudiante "+$("#estudiante").val());
    console.log("grado "+$("#grado").val());
    console.log("periodo "+event.target.value);

    $("#periodo").val(event.target.value);

    rederScoresTable($("#estudiante").val(),$("#grado").val(),event.target.value);

  }

  function rederScoresTable(estudiante,grado,periodo)
  {
    $.post( "/materiagrado", {_token:$('meta[name="csrf-token"]').attr('content'),grado,periodo,estudiante},
     function( data ) {
      console.log(data);
        let html = "";
        data.Materias.forEach(materia => {
          html += "<tr>";
            html += "<td>";
            html += materia.nombre;
            html += "</td>";
            html += "<td>";
            materia.calificacion = materia.calificacion ? materia.calificacion : "";
            html += materia.calificacion;
            html += "</td>";
            html += "<td>";
            html += "<button class='btn btn-primary' onclick='qualifyAchivements("+estudiante+","+materia.id+","+periodo+" )' > Calificar Logros </button>";
            html += "</td>";
          html += "</tr>";
        });

        $("#coursesData").html(html);

    });
  }

  function resetScoresTable()
  {
    $("#selectPeriod").val('');
      let html = "";
      html += "<tr>";
        html += "<td>";
        html += "</td>";
        html += "<td>";
        html += "</td>";
        html += "<td>";
        html += "</td>";
      html += "</tr>";
      $("#coursesData").html(html);
  }


  function OpenSee(id)
  {
    console.log ("Hola Mundo");
  }

  function makeQualification(estudiante,materia){
    console.log(estudiante);
    console.log(materia);

    $("#materia").val(materia);
    $("#estudiante").val(estudiante);


    $("#qualificationModal").modal("show");
  }

  function qualifyAchivements(estudiante,materia,periodo)
  {
    $.post( "/qachivements", {_token:$('meta[name="csrf-token"]').attr('content'),estudiante,materia,periodo},
     function( data ) {
       console.log(data);

       let html = "";
       data.Logros.forEach(logro => {
         html += "<tr>";
           html += "<td>";
           html += logro.logro;
           html += "</td>";
           html += "<td>";
           html += "";
           html += "</td>";
           html += "<td>";
           html += "<button class='btn btn-primary' onclick='makeQualification("+estudiante+","+materia+")' > Calificar </button>";
           html += "</td>";
         html += "</tr>";
       });

       $("#achivementsData").html(html);

     });

     $("#AchivementsModal").modal("show");
  }

  /*    var data = {};
    data.d = [{materia: 'Español' , nota:'', calificar:'' },
              {materia: 'Matematicas', nota:'', calificar:''},
              {materia: 'Ciencias Sociales', nota: '', calificar:''}];

    $('#thetable tr').not(':first').not(':last').remove();
    var html = '';
    for(var i = 0; i < data.d.length; i++)
                html += '<tr><td>' + data.d[i].materia + '</td><td>' + data.d[i].nota + '</td><td>'+data.d[i].calificar+'</td></tr>';
    $('#thetable tr').first().after(html);
*/


$("#ScoreForm").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    let form = $(this);
    let url = form.attr('action');

    $.ajax({
       type: "POST",
       url: url,
       data: form.serialize(), // serializes the form's elements.
       success: function(data)
       {
           console.log(data);
           $("#qualificationModal").modal("hide");
           rederScoresTable($("#estudiante").val(), $("#grado").val(), $("#periodo").val());
           alert("datos guardados");
           $("#ScoreForm").trigger("reset");
       }
     });


});

function generateExcel(id)
{
  //window.location.href = '/downloadExcel/'+id;
  window.open('/downloadExcel/'+id, '_blank');
}


</script>
@endsection
