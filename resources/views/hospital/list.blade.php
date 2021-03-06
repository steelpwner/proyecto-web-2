<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospitales</title>
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
                     @if (count($hospitales) == 0)
                     <a href="{{route("hospital.create")}}">
                           <button class="btn btn-link">
                              Crear
                           </button>
                           <br>
                           <br>
                     </a>
                     @endif
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
                  
                  @foreach ($hospitales as $actual)
                     <div class="modal modal-animated--zoom-in" id="delete-modal-{{$actual->id}}">
                        <a href="#" class="modal-overlay close-btn" aria-label="Close"></a>
                        <div class="modal-content">
                           <div class="modal-body u-text-center">
                              <p>Al eliminar este hospital se eliminar??n todos los doctores, incidencias y pacientes
                                 Relacionados a este ??Est?? seguro?</p>
                                    <form action="{{route("hospital.destroy",$actual->id)}}" method="POST">@csrf @method("delete")<button class="btn-link">S??</button></form>
                                    <a href="#" aria-label="Close">
                                       <button class="btn btn-link">No</button>
                                    </a>
                                 </div>
                        </div>
                     </div>
                     @endforeach
                  <div class="overflow p2m table">
                  <table class="table bordered" id="tbl" width="100%">
                     <thead>
                         <tr>
                             <th><abbr title="Nombre del hospital">Nombre</abbr></th>
                             <th><abbr title="Direcci??n del hospital">Direcci??n</abbr></th>
                             <th><abbr title="Tel??fono del hospital">Tel??fono</abbr></th>
                             <th><abbr title="Acciones de registro">Acci??n</abbr></th>
                         </tr>
                     </thead>
                     <tbody>
                        @if (count($hospitales) > 0)
                        @foreach ($hospitales as $actual)
                           <tr>
                              <th>{{$actual->nombre}}</th>
                              <td>{{$actual->direccion}}</td>
                              <td>{{$actual->telefono}}</td>
                              <td>
                                 <form action="{{route("hospital.edit",$actual->id)}}"><button class="btn-link">Editar</button></form>
                                 <a href="#delete-modal-{{$actual->id}}"><button class="btn btn-link">Borrar</button></a>
                              </td>
                           </tr>
                         @endforeach
                         @else
                         <tr>
                            <th colspan="4" class="text-center">
                              <h6>No existen hospitales actualmente</h6>
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
			"zeroRecords": "No hay ning??n registro",
			"info": "P??gina _PAGE_ de _PAGES_",
			"infoEmpty": "No hay registros disponibles",
			"infoFiltered": "(Filtrados de _MAX_)",
			"search":"Buscar",
			"paginate": {
				"first":      "Primera p??gina",
				"last":       "??ltima p??gina",
				"next":       "Siguiente",
				"previous":   "Anterior"
			}
		}
	})
  </script>
</body>
</html>