<?php
  session_start();

  if(!isset($_SESSION["numUsuario"])) {
    header("Location: iniciarss.php");
  }
?>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- PAGE settings -->
  <link rel="icon" href="universidad.png">
  <title>AYUDA</title>
  <meta name="description" content="Wireframe design of a cover page by Pingendo">
  <meta name="keywords" content="Pingendo bootstrap example template wireframe cover">
  <meta name="author" content="Pingendo">
  <!-- CSS dependencies -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="wireframe.css">


  <!-- Pruebas -->
  <style>
    .contenido {
      display: none;
    }
    .abierto {
      display: block;
    }
    .Pregunta{
      padding-left: 50px;
      padding-right: 50px;
      background-color: white;
      color: black;
    }
  </style>  



</head>

<body class="text-center bg-dark">
  <div class="row bg-dark">
    <div class="mx-auto col-md-9">
      <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container">
          <a class="navbar-brand" href="#"><b>Ayuda</b></a>
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent" aria-controls="navbar2SupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> </button>
          <div class="collapse navbar-collapse text-center justify-content-end" id="navbar2SupportedContent">
          <ul class="navbar-nav">
          <?php
                if($_SESSION["nivelUsuario"] == 2) {
                  echo "<li class='nav-item'>
                  <a class='nav-link' href='Menu.php'><b class='text-primary'>Menu</b></a>
                  </li>";
                  echo "<li class='nav-item'>
                  <a class='nav-link' href='users.php'><b class='text-primary'>Usuarios</b></a>
                  </li>";
                } else if($_SESSION["nivelUsuario"] == 3) {
                  echo "<li class='nav-item'>
                  <a class='nav-link' href='Menu.php'><b class='text-primary'>Menu</b></a>
                  </li>";
                }
              ?>
              <li class="nav-item">
                <a class="nav-link" href="planEs.php"><b>Plan de estudios</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="kardex.php"><b>Kardex</b></a>
              </li>
              <li class="nav-item"><a class="nav-link" href="MapaCurricular.php">Mapa Curricular</a></li>
              <li class="nav-item"><a class="nav-link" href="Estadisticas.php">Estadisticas</a></li>
              <li class="nav-item"><a class="nav-link" href="Ayuda.php">Ayuda<br></a></li>
              <li class="nav-item"><a class="nav-link" href="iniciarss.php?code=1">Salir</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </div>
  <div class="p-3 d-flex flex-column my-0 mx-0 ml-0 mr-0 mt-0 mb-0 m-0 h-25 bg-info">
    <div class="container">
      <div class="row">
        <div class="col-md-8 mx-auto">
          <h1 class="cover-heading" style=""><b>Hola, ¿en que te podemos ayudar?</b></h1>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5 bg-info">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <p align="center">
            <img class="img-fluid d-block rounded-circle" src="https://acelerapyme.itg.es/wp-content/uploads/2022/06/question-mark-query-information-support-service-graphic-1024x633.jpeg">
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5 bg-info">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-md-10">
          <div class="mbr-section-head align-center mb-4">
            <h3 class="mbr-section-title mb-0 mbr-fonts-style display-2">
              <strong>Preguntas Frecuentes</strong></h3>
          </div>
          <div id="bootstrap-accordion_8" class="panel-group accordionStyles accordion" role="tablist" aria-multiselectable="true">
            <div class="card mb-3">
              <div class="card-header" role="tab" id="headingOne">
                <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse1_8" aria-expanded="false" aria-controls="collapse1">
                  <h6 class="panel-title-edit mbr-fonts-style mb-0 display-7"><strong>¿Como inscribir una materia?</strong></h6>
                  <span class="sign mbr-iconfont mbri-arrow-down"></span>
                </a>
              </div>
              <div id="collapse1_8" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" data-bs-parent="#bootstrap-accordion_8">
                <div class="panel-body">
                  <p class="mbr-fonts-style panel-text display-4">The number of items is limited in this block. Open the Block parameters to change the amount of items.</p>
                </div>
              </div>
            </div>
            <div class="card mb-3">
              <div class="card-header" role="tab" id="headingOne">
                <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse2_8" aria-expanded="false" aria-controls="collapse2">
                  <h6 class="panel-title-edit mbr-fonts-style mb-0 display-7"><strong>¿Como crear una cuenta?</strong></h6>
                  <span class="sign mbr-iconfont mbri-arrow-down"></span>
                </a>
              </div>
              <div id="collapse2_8" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" data-bs-parent="#bootstrap-accordion_8">
                <div class="panel-body">
                  <p class="mbr-fonts-style panel-text display-4"> Mobirise Kit is a service that provides the access to all current and new themes/extensions developed by Mobirise. New themes/extensions are released every month and will be available in your account during your plan period, without any additional charge.</p>
                </div>
              </div>
            </div>
            <div class="card mb-3">
              <div class="card-header text-body" role="tab" id="headingOne">¿Como eliminar materias?</div>
              <div id="collapse3_8" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" data-bs-parent="#bootstrap-accordion_8">
                <div class="panel-body">
                  <p class="mbr-fonts-style panel-text display-4"> Yes, Mobirise is free for both non-profit and commercial sites.</p>
                </div>
              </div>
            </div>
            <div class="card mb-3">
              <div class="card-header" role="tab" id="headingOne">
                <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse4_8" aria-expanded="false" aria-controls="collapse4">
                  <h6 class="panel-title-edit mbr-fonts-style mb-0 display-7"><strong>¿Como checar el plan educativo?</strong></h6>
                  <span class="sign mbr-iconfont mbri-arrow-down"></span>
                </a>
              </div>
              <div id="collapse4_8" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" data-bs-parent="#bootstrap-accordion_8">
                <div class="panel-body">
                  <p class="mbr-fonts-style panel-text display-4"> This extension allows editing the code of block in the app. Also, it's possible to add code to the head and body parts of pages.</p>
                </div>
              </div>
            </div>
            <div class="card mb-3">
              <div class="card-header" role="tab" id="headingOne">
                <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse5_8" aria-expanded="false" aria-controls="collapse5">
                  <h6 class="panel-title-edit mbr-fonts-style mb-0 display-7"><strong>¿Como checar donde me toca?</strong></h6>
                  <span class="sign mbr-iconfont mbri-arrow-down"></span>
                </a>
              </div>
              <div id="collapse5_8" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" data-bs-parent="#bootstrap-accordion_8">
                <div class="panel-body">
                  <p class="mbr-fonts-style panel-text display-4"> Mobirise Kit is a service that provides the access to all current and new themes/extensions developed by Mobirise. New themes/extensions are released every month and will be available in your account during your plan period, without any additional charge.</p>
                </div>
              </div>
            </div>
            <div class="card mb-3">
              <div class="card-header" role="tab" id="headingOne">
                <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse6_8" aria-expanded="false" aria-controls="collapse6">
                  <h6 class="panel-title-edit mbr-fonts-style mb-0 display-7"><strong>¿Como consulto mi horario?</strong></h6>
                  <span class="sign mbr-iconfont mbri-arrow-down"></span>
                </a>
              </div>
              <div id="collapse6_8" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" data-bs-parent="#bootstrap-accordion_8">
                <div class="panel-body">
                  <p class="mbr-fonts-style panel-text display-4"> Yes, Mobirise is free for both non-profit and commercial sites.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>






      <div id="bootstrap-accordion_8" class="panel-group accordionStyles accordion" role="tablist" aria-multiselectable="true">
        <div onclick="mostrarContenido(this)">
          
          <div class="card mb-3">
              <div class="card-header text-body" role="tab" id="headingOne">¿Como eliminar materias?</div>
                  <div id="collapse3_8" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" data-bs-parent="#bootstrap-accordion_8">
                    <div class="panel-body">
                      <p class="mbr-fonts-style panel-text display-4"> Yes, Mobirise is free for both non-profit and commercial sites.</p>
              </div>
            </div>
          </div>
          <div class="contenido">
            <p>Ve ala parte Perfil Mis Materias</p>
          </div>
        </div>
      </div>


    <script>
      function mostrarContenido(elemento) {
        var contenido = elemento.querySelector('.contenido');
        contenido.classList.toggle('abierto');
      }
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous" style=""></script>
  </div>
  <div class="py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center d-md-flex justify-content-between align-items-center">
          <ul class="nav d-flex justify-content-center">
            <li class="nav-item"> <a class="nav-link active" href="#">Inicio</a> </li>
            <li class="nav-item"> <a class="nav-link" href="#">contacto</a> </li>
            <li class="nav-item"> <a class="nav-link" href="#">Redes sociales</a> </li>
            <li class="nav-item"> <a class="nav-link" href="#">mas acerca</a> </li>
          </ul>
          <p class="mb-0 py-1">© 2023&nbsp; Universidad Politecnica de San Luis Potosi</p>
        </div>
      </div>
    </div>
  </div>
</body>

</html>