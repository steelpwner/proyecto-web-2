<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Doctor</title>
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
                  <div class="row">
                    <div class="col-12">
                        <div class="u-text-left">
                            <a href="{{route('doctor.index')}}">
                                  <button class="btn btn-link">
                                     Atrás
                                  </button><br><br>
                            </a>
                         </div>
                    </div>
                    <div class="col-12">
                        <form action="{{route("doctor.update",$doctor->id)}}" method="POST">
                            @csrf
                            @method("PUT")
                            <div class="row ignore-screen level">
                                <div class="col-3 ignore-screen level-item"><p class="m-0">Nombre Completo:</span></div>
                                <div class="col-9 ignore-screen level-item"><input type="text" name="nombre_completo" class=" @error('nombre_completo') input-error @enderror" value="{{$doctor->nombre_completo}}" required></div>
                            </div>
                            <div class="row ignore-screen level">
                                <div class="col-3 ignore-screen level-item"><p class="m-0">Dirección:</span></div>
                                <div class="col-9 ignore-screen level-item"><input type="text" name="direccion" value="{{$doctor->direccion}}" class=" @error('direccion') input-error @enderror" required></div>
                            </div>
                            <div class="row ignore-screen level">
                                <div class="col-3 ignore-screen level-item"><p class="m-0">Teléfono:</span></div>
                                <div class="col-9 ignore-screen level-item"><input type="text" name="telefono" value="{{$doctor->telefono}}" class=" @error('telefono') input-error @enderror" required></div>
                            </div>
                            <div class="row ignore-screen level">
                                <div class="col-3 ignore-screen level-item"><p class="m-0">Tipo sangre:</span></div>
                                <div class="col-9 ignore-screen level-item">
                                    <select name="tipo_sangre" class=" @error('tipo_sangre') input-error @enderror" required>
                                        <option value="" disabled>Seleccione un tipo de sangre</option>
                                        <option value="O-" @if ($doctor->tipo_sangre == "O-") selected @endif >O-</option>
                                        <option value="O+" @if ($doctor->tipo_sangre == "O+") selected @endif>O+</option>
                                        <option value="A-">A- @if ($doctor->tipo_sangre == "A-") selected @endif</option>
                                        <option value="A+" @if ($doctor->tipo_sangre == "A+") selected @endif>A+</option>
                                        <option value="B-" @if ($doctor->tipo_sangre == "B-") selected @endif>B-</option>
                                        <option value="B+" @if ($doctor->tipo_sangre == "B+") selected @endif>B+</option>
                                        <option value="AB-" @if ($doctor->tipo_sangre == "AB-") selected @endif>AB-</option>
                                        <option value="AB+" @if ($doctor->tipo_sangre == "AB+") selected @endif>AB+</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row ignore-screen level">
                                <div class="col-3 ignore-screen level-item"><p class="m-0">Años experiencia:</span></div>
                                <div class="col-9 ignore-screen level-item"><input type="number" name="años_experiencia" class=" @error('años_experiencia') input-error @enderror" value="{{$doctor->años_experiencia}}" required></div>
                            </div>
                            <div class="row ignore-screen level">
                                <div class="col-3 ignore-screen level-item"><p class="m-0">Fecha nacimiento:</span></div>
                                <div class="col-9 ignore-screen level-item"><input type="date" name="fecha_nacimiento" class=" @error('fecha_nacimiento') input-error @enderror" value="{{$doctor->fecha_nacimiento}}" required></div>
                            </div>
                            <div class="row ignore-screen level">
                                <div class="col-3 ignore-screen level-item"><p class="m-0">Hospital:</span></div>
                                <div class="col-9 ignore-screen level-item">
                                    <select name="hospital"  class=" @error('hospital') input-error @enderror" required>
                                        <option value="" disabled>Seleccione un hospital</option>
                                        @foreach ($hospitales as $actual)
                                            <option value="{{$actual->id}}" @if ($doctor->hospital == $actual->nombre) selected @endif>{{$actual->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
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