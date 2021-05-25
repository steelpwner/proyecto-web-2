<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incidencias</title>
    <link rel="stylesheet" href="{{asset("./Cirrus-0.6.1/dist/cirrus.css")}}">
    <link rel="stylesheet" href="{{asset("./Cirrus-0.6.1/dist/cirrus-core.css")}}">
    <link rel="stylesheet" href="{{asset("./css/page.css")}}">
    <link rel="stylesheet" href="{{asset("./datatables/jQuery-3.3.1/jquery-3.3.1.min.js")}}">
    <link rel="stylesheet" href="{{asset("./datatables/datatables.min.css")}}">
    <script src="{{asset("./datatables/datatables.min.js")}}"></script>
</head>
<body>
    <div class="header unselectable header-animated">
        <div class="header-brand">
           <div class="nav-item no-hover">
              <h6 class="title">Proyecto Web II</h6>
           </div>
           <div class="nav-item nav-btn" id="header-btn"> <span></span> <span></span> <span></span> </div>
        </div>
        <div class="header-nav" id="header-menu">
           <div class="nav-left">
              <div class="nav-item text-center"> <a href="{{route("home")}}">Inicio</a></div>
              <div class="nav-item text-center"> <a href="{{route("hospital.index")}}">Hospitales</a> </div>
              <div class="nav-item text-center"> <a href="{{route("doctor.index")}}">Doctores</a> </div>
              <div class="nav-item text-center"> <a href="{{route("paciente.index")}}">Pacientes</a> </div>
              <div class="nav-item text-center"> <a href="{{route("incidencia.index")}}">Incidencias</a> </div>
           </div>
        </div>
     </div>
     <section class="section">
        <div class="hero">
           <div class="hero-body">
              <div class="content">
                 <div class="text-center">
                  <div class="text-left">
                     <a href="{{route("incidencia.create")}}">
                           <button class="btn btn-link">
                              Crear
                           </button>
                           <br>
                           <br>
                     </a>
                     @if (Session::has('success'))
                        <div class="toast toast--success">
                           <button class="btn-close"></button>
                           <p>{!! Session::get('success') !!}</p>
                        </div>
                        <script>
                           x = document.querySelectorAll(".btn-close")
                           for (i = 0; i < x.length; i++) {
                              x[i].addEventListener("click",function(e) {
                                 e.target.parentElement.className += " hidden"
                              })
                           }
                        </script>
                     @endif
                     @if (Session::has('error'))
                        <div class="toast toast--primary">
                           <button class="btn-close"></button>
                           <p>{!! Session::get('error') !!}</p>
                        </div>

                        <script>
                           x = document.querySelectorAll(".btn-close")
                           for (i = 0; i < x.length; i++) {
                              x[i].addEventListener("click",function(e) {
                                 e.target.parentElement.className += " hidden"
                              })
                           }
                        </script>
                     @endif
                  </div>
                  <div class="overflow">
                     <table class="table bordered" id="tbl" width="100%">
                        <thead>
                           <tr>
                              <th><abbr title="Nombre del acompañante">Nombre acompañante</abbr></th>
                              <th><abbr title="Teléfono del acompañante">Teléfono acompañante</abbr></th>
                              <th><abbr title="Nombre del paciente">Nombre del paciente</abbr></th>
                              <th><abbr title="¿Antecedentes médicos?">Antecedentes médicos</abbr></th>
                              <th><abbr title="Motivos consulta">Motivos consulta</abbr></th>
                              <th><abbr title="Síntomas">Síntomas</abbr></th>
                              <th><abbr title="Diagnóstico doctor">Diagnóstico doctor</abbr></th>
                              <th><abbr title="Acciones paciente">Acciones</abbr></th> 
                            </tr>
                        </thead>
                        <tbody>

                           @if (count($incidencias) > 0)
                           @foreach ($incidencias as $actual)
                              <tr>
                                 <th>{{json_decode($actual->acompañante,true  )['nombre']}}</th>
                                 <td>{{json_decode($actual->acompañante,true)['telefono']}}</td>
                                 <td>{{$actual->nombre_paciente}}</td>
                                 @if ($actual->antecedentes_medicos != "")                                
                                     <td>{{$actual->antecedentes_medicos}}</td>
                                 @else
                                     <td>No</td>
                                 @endif
                                 <td>{{$actual->motivos_consulta}}</td>
                                 <td>
                                     @foreach(array_keys(json_decode($actual->sintomas,true)) as $sintoma)
                                       {{$sintoma.": ".json_decode($actual->sintomas,true)[$sintoma]}}
                                     @endforeach
                                 </td>
                                 <td>
                                    {{$actual->diagnostico_doctor}}
                                 </td>
                                 <td class="row u-justify-space-around">
                                    <form action="{{route("incidencia.edit",$actual->id)}}"><button class="btn-link">Editar</button></form>
                                    <form action="{{route("incidencia.destroy",$actual->id)}}" method="POST">@csrf @method("delete")<button class="btn-link">Borrar</button></form>
                                 </td>
                              </tr>
                           @endforeach
                           @else
                           <tr>
                              <th colspan="8" class="text-center">
                                 <h6>No existen incidencias actualmente</h6>
                              </th>
                           </tr>
                           @endif
                        </tbody>
                  </table>
               </div>
                 </div>
              </div>
           </div>
        </div>
     </section>
     <script>
      // Get all the nav-btns in the page
     let navBtns = document.querySelectorAll('.nav-btn');

     // Add an event handler for all nav-btns to enable the dropdown functionality
     navBtns.forEach(function (ele) {
         ele.addEventListener('click', function() {
             // Get the dropdown-menu associated with this nav button (insert the id of your menu)
             let dropDownMenu = document.getElementById('header-menu');

             // Toggle the nav-btn and the dropdown menu
             ele.classList.toggle('active');
             dropDownMenu.classList.toggle('active');
         });
     });
     $("#tbl").DataTable({
			"lengthMenu": [ 5, 10, 25, 50, 75, 100 ],
			"paging": true,
			"pageLength":50,
			"scrollX": "100%",
			"order":[],
			"ordering": false,
			"scrollCollapse": true,
			"language": { "lengthMenu":"Mostrando _MENU_ registros",
			"zeroRecords": "No hay ningún registro",
			"info": "Página _PAGE_ de _PAGES_",
			"infoEmpty": "No hay registros disponibles",
			"infoFiltered": "(Filtrados de _MAX_)",
			"search":"Buscar",
			"paginate": {
				"first":      "Primera página",
				"last":       "Última página",
				"next":       "Siguiente",
				"previous":   "Anterior"
			}
		}
	})
  </script>
</body>
</html>