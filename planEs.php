<?php
  session_start();

  if(!isset($_SESSION["numUsuario"])) {
    header("Location: iniciarss.php");
  }
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- PAGE settings -->
  <link rel="icon" href="universidad.png">
  <title>Plan de Estudios</title>
  <meta name="description" content="Wireframe design of a cover page by Pingendo">
  <meta name="keywords" content="Pingendo bootstrap example template wireframe cover">
  <meta name="author" content="Pingendo">
  <!-- CSS dependencies -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="wireframe.css">
</head>
<style>
  /* Estilos para la tabla */
    table {
      width: 100%;
      border-collapse: collapse;
    }
    
    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
</style>

<body class="text-center bg-info">
  <div class="row bg-dark">
    <div class="mx-auto col-md-9">
      <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container">
          <a class="navbar-brand" href="#"><b>Plan de Estudios</b></a>
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent" aria-controls="navbar2SupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> </button>
          <div class="collapse navbar-collapse text-center justify-content-end" id="navbar2SupportedContent">
            <ul class="navbar-nav">
              <?php
                if($_SESSION["nivelUsuario"] == 2) {
                  echo "<li class='nav-item'>
                  <a class='nav-link' href='users.php'><b class='text-primary'>Usuarios</b></a>
                  </li>";
                } else if($_SESSION["nivelUsuario"] == 3) {
                  echo "<li class='nav-item'>
                  <a class='nav-link' href='Menu.php'><b class='text-primary'>Menú</b></a>
                  </li>";
                }
              ?>
              
              <li class="nav-item">
                <a class="nav-link active" href="planEs.php"><b>Plan de estudios</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="kardex.php"><b>Kardex</b></a>
              </li>
              <li class="nav-item"><a class="nav-link" href="MapaCurricular.php">Mapa Curricular</a></li>
              <li class="nav-item"><a class="nav-link" href="Estadisticas.php">Estadisticas</a></li>
              <li class="nav-item"><a class="nav-link" href="Ayuda.php">Ayuda</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </div>
  <div class="py-3 bg-info">

  <?php
           
    if($_SESSION["nivelUsuario"] == 2) { //Si es Profesor
      echo "<div class='container'>
      <div class='row'>
        <div class='col-md-12 mx-auto'>
            <a class='btn btn-primary mx-3 mb-5' href='nuevoPlan.php'>Nuevo</a>
            <a class='btn btn-primary mx-3 mb-5' href='#'>Importar</a>
        </div>
      </div>
      <div class='row'>
      </div>
    </div>
  </div>
    <table class='table table-bordered '>
    <thead class='thead-dark'>
    <tr>
      <th>Clave del Plan</th>
      <th>Nombre del Plan</th>
      <th>Actualizar</th>
      <th>Eliminar</th>
    </tr>
    </thead>";

      include 'consultaPlanEstudios.php';
      $planes = obtenerPlanesEstudios();

      if ($planes->num_rows > 0) {
        // Recorrer los resultados y generar las filas de la tabla
        while ($row = $planes->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["clavePlan"] . "</td>";
          echo "<td>" . $row["nombrePlan"] . "</td>";
          echo "<td><a class='btn btn-primary mx-3 mb-2' href='actualizar_plan.php?clave=" . $row["clavePlan"] . "'>Actualizar</a></td>";
          echo "<td><a class='btn btn-primary mx-3 mb-2' href='eliminar_plan.php?clave=" . $row["clavePlan"] . "'>Eliminar</a></td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='2'>No hay planes de estudios disponibles</td></tr>";
      }

    } else if($_SESSION["nivelUsuario"] == 3) { //Si es alumno
      echo "<table class='table table-bordered '>
      <thead class='thead-dark'>
      <tr>
        <th>Clave del Plan</th>
        <th>Nombre del Plan</th>
      </tr>
      </thead>";
        include 'consultaPlanEstudios.php';
        $planes = obtenerPlanesEstudios();
  
        if ($planes->num_rows > 0) {
          // Recorrer los resultados y generar las filas de la tabla
          while ($row = $planes->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['clavePlan'] . '</td>';
            echo '<td>' . $row['nombrePlan'] . '</td>';
            echo '</tr>';
          }
        } else {
          echo "<tr><td colspan='2'>No hay planes de estudios disponibles</td></tr>";
        }
    }
          

  ?>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>