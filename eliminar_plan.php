<?php
    // Verificar si se ha proporcionado la clave del plan de estudios
    if (!isset($_GET['clave'])) {
      echo "Clave del plan de estudios no proporcionada.";
      exit;
    }

    // Obtener la clave del plan de estudios desde la URL
    $clavePlan = $_GET['clave'];

    // Realizar la actualización en la base de datos
    $server = "www.db4free.net";
    $user = "userweb2";
    $passwd = "u5LciU#J";
    $database = "dbescuela";

    // Crear la conexión
    $conn = new mysqli($server, $user, $passwd, $database);

    // Verificar la conexión
    if ($conn->connect_error) {
      die("Error de conexión: " . $conn->connect_error);
    }

    // Consulta SQL para eliminar el plan de estudios
    $sql = "DELETE FROM planmateria WHERE clavePlan = '$clavePlan'";

    // Ejecutar la consulta SQL
    if ($conn->query($sql) === TRUE) {
      echo "El plan de estudios ha sido eliminado exitosamente.";
    } else {
      echo "Error al eliminar el plan de estudios: " . $conn->error;
    }

    $conn->close();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- PAGE settings -->
  <link rel="icon" href="https://templates.pingendo.com/assets/Pingendo_favicon.ico">
  <title>Plan de Estudios</title>
  <meta name="description" content="Wireframe design of a cover page by Pingendo">
  <meta name="keywords" content="Pingendo bootstrap example template wireframe cover">
  <meta name="author" content="Pingendo">
  <!-- CSS dependencies -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="wireframe.css">
</head>
<style>
  /* Estilos para el formulario */
    .form-group {
      margin-bottom: 15px;
    }
    
    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }
    
    input[type="text"] {
      width: 100%;
      padding: 5px;
      font-size: 14px;  
    }
    
    input[type="submit"] {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
    }
</style>

<body class="text-center bg-info">
  <div class="row bg-dark">
    <div class="mx-auto col-md-9">
      <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container">
          <a class="navbar-brand" href="planEs.php"><b>Plan de Estudios</b></a>
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
              <li class="nav-item"><a class="nav-link" href="Mapa Curricular.html">Mapa Curricular</a></li>
              <li class="nav-item"><a class="nav-link" href="EStadisticas.html">Estadisticas</a></li>
              <li class="nav-item"><a class="nav-link" href="Ayuda.html">Ayuda</a></li>
              <li class="nav-item"><a class="nav-link" href="iniciarss.php?code=1">Salir</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </div>
  <div class="container">
    <a class='btn btn-primary mx-3 mb-5' href='planEs.php'>Aceptar</a>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>
