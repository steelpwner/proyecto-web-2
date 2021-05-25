<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Incidencia</title>
    <link rel="stylesheet" href="{{asset("./Cirrus-0.6.1/dist/cirrus.css")}}">
    <link rel="stylesheet" href="{{asset("./css/page.css")}}">
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
                            <a href="{{route('incidencia.index')}}">
                                  <button class="btn btn-link">
                                     Atrás
                                  </button><br><br>
                            </a>
                         </div>
                    </div>
                    <div class="col-12">
                        <form action="{{route("incidencia.store")}}" method="POST">
                            @if($errors->any())
                            <div id="error-box">
                                <!-- Display errors here -->
                                <ul>
                                @foreach($errors as $error)
                                    
                                <li>{{!! $error !!}}</li>
                                @endforeach
                                </ul>
                            </div>
                            @endif
                            @csrf
                            <div class="row ignore-screen level">
                                <div class="col-3 ignore-screen level-item"><p class="m-0">Paciente:</span></div>
                                <div class="col-9 ignore-screen level-item">
                                    <select name="paciente" class=" @error('paciente') input-error @enderror" required >
                                        <option value="" disabled selected>Seleccione un paciente</option>
                                        @foreach ($pacientes as $actual)
                                            <option value="{{$actual->id}}">{{$actual->nombre." - ".$actual->direccion. " - ".$actual->eps}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><br>
                            <p class="u-text-center">¿No encuentra al paciente que busca? puede <a href="{{route("paciente.create")}}" class="btn btn-link p-2">Ir a crearlo</a></p>
                            <div class="row ignore-screen level">
                                <div class="col-3 ignore-screen level-item"><p class="m-0">Nombre de acompañante:</span></div>
                                <div class="col-9 ignore-screen level-item"><input class=" @error('nombre_a') input-error @enderror" type="text" name="nombre_a" required></div>
                            </div>
                            <div class="row ignore-screen level">
                                <div class="col-3 ignore-screen level-item"><p class="m-0">Teléfono acompañante:</span></div>
                                <div class="col-9 ignore-screen level-item"><input class="@error('telefono_a') input-error @enderror" type="text" name="telefono_a" required></div>
                            </div>
                            <div class="row ignore-screen level">
                                <div class="col-3 ignore-screen level-item"><p class="m-0">¿Tiene antecedentes médicos?</span></div>
                                <label><input type="radio" name="antecedentes" value="no" class=" @error('antecedentes') input-error @enderror" onClick="toggle(this)" checked>No</label>
                                <label><input type="radio" name="antecedentes" value="si" onClick="toggle(this)" class=" @error('antecedentes') input-error @enderror">Sí</label>
                            </div>
                            <div class="row ignore-screen level hidden" id="divantecedentes">
                                <div class="col-3 ignore-screen level-item"><p class="m-0">¿Cuáles son?</span></div>
                                <textarea name="antecedentes-text" class=" @error('antecedentes-text') input-error @enderror"></textarea>
                            </div>
                            <div class="row ignore-screen level">
                                <div class="col-3 ignore-screen level-item"><p class="m-0">Motivos de consulta:</span></div>
                                <textarea name="motivos_consulta" class=" @error('motivos_consulta') input-error @enderror" required></textarea>
                            </div>
                            <div class="u-text-center"><p class="m-0">¿Sufre o ha sufrido alguno de estos síntomas?:</span></div>
                                
                            @foreach($sintomas as $sintoma)
                                <div class="row ignore-screen level">
                                    <div class="col-3 ignore-screen level-item"><p class="m-0">{{$sintoma}}</span></div>
                                        <label><input type="radio" name="{{str_replace(" ","+",$sintoma)}}" value="no" checked>No</label>
                                        <label><input type="radio" name="{{str_replace(" ","+",$sintoma)}}" value="si">Sí</label>
                                </div>
                            @endforeach
                                
                            <div class="row ignore-screen level">
                                <div class="col-3 ignore-screen level-item"><p class="m-0">Diagnostico del doctor</span></div>
                                <textarea name="diagnostico_doctor" class=" @error('diagnostico_doctor') input-error @enderror" required></textarea>
                            </div>

                            <div class="u-text-right">
                                <button class="btn btn-link">
                                    Crear
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

        
        function toggle(x) {
            console.log(x)
            y = document.querySelector("#divantecedentes")
            console.log(y)
            if (x.value == "no") {
                if (!y.className.includes("hidden")) {
                    y.className += " hidden"
                    document.querySelector("#divantecedentes textarea").value = ""
                }
            } else {
                y.className = y.className.replace("hidden","")
            }
        }

     </script>
</body>
</html>