<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Hospital</title>
    <link rel="stylesheet" href="{{asset("./Cirrus-0.6.1/dist/cirrus.css")}}">
    <link rel="stylesheet" href="{{asset("./Cirrus-0.6.1/dist/cirrus-core.css")}}">
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
                  <div class="u-text-left">
                     <a href="{{route('hospital.index')}}">
                           <button class="btn btn-link">
                              Atrás
                           </button><br><br>
                     </a>
                  </div>

                  <form action="{{route("hospital.update",$id)}}" method="POST">
                        @csrf
                        @method("PUT")
                        <div class="row ignore-screen level">
                            <div class="col-3 ignore-screen level-item"><p class="m-0">Nombre:</span></div>
                            <div class="col-9 ignore-screen level-item"><input type="text" name="nombre" value="{{$hospital->nombre}}" required></div>
                        </div>
                        <div class="row ignore-screen level">
                            <div class="col-3 ignore-screen level-item"><p class="m-0">Dirección:</span></div>
                            <div class="col-9 ignore-screen level-item"><input type="text" name="direccion" value="{{$hospital->direccion}}" required></div>
                        </div>
                        <div class="row ignore-screen level">
                            <div class="col-3 ignore-screen level-item"><p class="m-0">Teléfono:</span></div>
                            <div class="col-9 ignore-screen level-item"><input type="text" name="telefono" value="{{$hospital->telefono}}" required></div>
                        </div>
                        

                        <div class="u-text-right">
                            <button class="btn btn-link">
                                Editar
                            </button>
                        </div>
                  </form>
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
  </script>
</body>
</html>