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
  <link rel="icon" href="https://templates.pingendo.com/assets/Pingendo_favicon.ico">
  <title>Menu</title>
  <meta name="description" content="Wireframe design of a cover page by Pingendo">
  <meta name="keywords" content="Pingendo bootstrap example template wireframe cover">
  <meta name="author" content="Pingendo">
  <!-- CSS dependencies -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="wireframe.css">
</head>

<body class="text-center bg-dark">
  <nav class="navbar navbar-expand-md navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="menu.html"><b>ELIMINAR ALUMNO</b></a>
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
  <div class="p-3 d-flex flex-column bg-info h-75" style="">
    <div class="container mb-auto">
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="cover-heading text-center text-light text-capitalize" style=" text-align: center; ">ELIMINAR ALUMNO</h1>
        </div>
      </div>
      <form action="validarelimina.php" method="post">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group"><label>MATRICULA A ELIMINAR</label><input class="form-control" required="" name="matricula"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12" style=""><button type="submit" class="btn btn-primary" name="submit">Submit</button></div>
        </div>
      </form>
    </div>
    <div class="container mt-auto bg-info"></div>
  </div>
  <div class="pt-3" style="">
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
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <pingendo onclick="window.open('https://pingendo.com/', '_blank')" style="cursor:pointer;position: fixed;bottom: 20px;right:20px;padding:4px;background-color: #00b0eb;border-radius: 8px; width:220px;display:flex;flex-direction:row;align-items:center;justify-content:center;font-size:14px;color:white">Made with Pingendo Free&nbsp;&nbsp;<img src="https://pingendo.com/site-assets/Pingendo_logo_big.png" class="d-block" alt="Pingendo logo" height="16"></pingendo>
</body>

</html>