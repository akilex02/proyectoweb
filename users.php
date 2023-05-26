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
  <title>Usuarios</title>
  <meta name="description" content="Wireframe design of a cover page by Pingendo">
  <meta name="keywords" content="Pingendo bootstrap example template wireframe cover">
  <meta name="author" content="Pingendo">
  <!-- CSS dependencies -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="wireframe.css">
</head>

<body class="text-center bg-dark">
  <div class="row bg-dark">
    <div class="mx-auto col-md-9">
      <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container">
            <?php
            if($_SESSION["nivelUsuario"] == 2) {
              echo "<a class=\"navbar-brand\" href=\"users.php\"><b>Usuarios</b></a>";
            } 
           ?>
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
  <div class="p-3 d-flex flex-column bg-info h-100" style="">
    <div class="container mb-auto">
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="cover-heading text-left" style=" text-align: center; "><b>Usuarios</b></h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 mx-auto">
          <div class="table-responsive" style="#table-responsive{}";>
            <table class="table table-bordered ">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Name</th></th>
                  <th>Password</th>
                  <th>Carrera</th>
                </tr>
              </thead>
              <tbody>
                <?php
                      // Load the database configuration file
                      include 'conn.php';
                      $conn = new mysqli($server, $user, $passwd, $database);
                      $cont = 0;
                  ?>
                  <?php
                  // Get member rows
                  $result = $conn->query("SELECT `claveAlumno`, `claveInterna`, `nombreAlumno`, `claveCarrera`, `password`, `tipo` FROM `alumno`;");
                  if($result->num_rows > 0){
                      while($row = $result->fetch_assoc()){
                  ?>
                        <tr>
                          <td><?php echo $row['claveInterna']; ?></td>
                          <td><?php echo $row['nombreAlumno']; ?></td>
                          <td><?php echo $row['password']; ?></td>
                          <?php
                          if($row['claveCarrera'] == 1){
                          ?>
                          <td><?php echo "ITI"; ?></td>
                          <?php
                          }?>
                          <?php
                          if($row['claveCarrera'] == 2){
                          ?>
                          <td><?php echo "ITEM"; ?></td>
                          <?php
                          }?>
                          <?php
                          if($row['claveCarrera'] == 3){
                          ?>
                          <td><?php echo "ITMA"; ?></td>
                          <?php
                          }?>
                          <?php
                          if($row['claveCarrera'] == 4){
                          ?>
                          <td><?php echo "ISTI"; ?></td>
                          <?php
                          }?>
                          <?php
                          if($row['claveCarrera'] == 5){
                          ?>
                          <td><?php echo "LAG"; ?></td>
                          <?php
                          }?>
                          <?php
                          if($row['claveCarrera'] == 6){
                          ?>
                          <td><?php echo "MERCA"; ?></td>
                          <?php
                          }?>
                        </tr>
                    <?php }}?>
              </tbody>
            </table>
          </div>
          <div class="row">
            <div class="col-md-12 mx-auto text-nowrap"><a class="btn btn-primary mx-2 border-dark border border-left border-right border-top border-bottom" href="nuevouser.php">Nuevo</a><a class="btn btn-primary mx-2 border border-left border-right border-top border-bottom" href="actualizaruser.php">Actualizar</a><a class="btn btn-primary mx-2 border border-left border-right border-top border-bottom" href="buscar.php">Buscar</a><a class="btn btn-primary mx-2 border border-left border-right border-top border-bottom" href="eliminar.php">Eliminar</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>

</html>