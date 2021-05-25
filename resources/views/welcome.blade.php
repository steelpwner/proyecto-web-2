<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inicio</title>
        <link rel="stylesheet" href="{{asset("./Cirrus-0.6.1/dist/cirrus.css")}}">
        <link rel="stylesheet" href="{{asset("./Cirrus-0.6.1/dist/cirrus-core.css")}}">
        <link rel="stylesheet" href="{{asset("./css/page.css")}}">
    </head>
    <body>
        <div class="header header-fixed unselectable header-animated">
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
            <div class="hero fullscreen">
               <div class="hero-body">
                  <div class="content">
                    <div class="u-text-center">
                        <h6>Proyecto web 2</h6>
                        <p>En este proyecto encontrará los siguientes módulos:</p>
                        <a href="{{route("hospital.index")}}">
                            <button class="btn-link">Hospital</button>
                        </a>
                        <a href="{{route("doctor.index")}}">
                            <button class="btn-link">Doctores</button>
                        </a>
                        <a href="{{route("paciente.index")}}">
                            <button class="btn-link">Pacientes</button>
                        </a><br><br>
                        <a href="{{route("incidencia.index")}}">
                            <button class="btn-link">Incidencias</button>
                        </a><br><br>
                        <p>Proyecto realizado por:</p>
                        <h6>Carlos Eduardo Ramos Villera</h6>
                        <h6>Diego Andrés Molina Estren</h6>
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
