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
  <title>Kardex</title>
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
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#"><b>Kardex</b></a>
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
            <a class="nav-link active" href="kardex.php"><b>Kardex</b></a>
          </li>
          <li class="nav-item"><a class="nav-link" href="MapaCurricular.php">Mapa Curricular</a></li>
          <li class="nav-item"><a class="nav-link" href="Estadisticas.php">Estadisticas</a></li>
          <li class="nav-item"><a class="nav-link" href="Ayuda.php">Ayuda<br></a></li>
          <li class="nav-item"><a class="nav-link" href="iniciarss.php?code=1">Salir</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="p-3 h-100 d-flex flex-column bg-info">
    <div class="container mb-auto">
      <div class="row">
        <div class="mx-auto col-md-9">
          <h1 class="cover-heading"><b>Kardex</b></h1>
          <form action="consulta_kardex.php" method="post">
          <div class="form-group">
            <label for="claveInterna">Clave Interna:</label>
            <?php
              if($_SESSION["nivelUsuario"] == 3) {
                echo "<input type='text' id='claveInterna' value='" . $_SESSION['numUsuario'] . "' name='claveInterna' disabled>";
              } else if ($_SESSION["nivelUsuario"] == 2) {
                echo "<input type='text' id='claveInterna' name='claveInterna' required>";
              }
            ?>
          </div>
          <div class="form-group">
            <input type="submit" value="Buscar">
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>