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
  <link rel="icon" href="https://templates.pingendo.com/assets/Pingendo_favicon.ico">
  <title>Kardex</title>
  <meta name="description" content="Wireframe design of a cover page by Pingendo">
  <meta name="keywords" content="Pingendo bootstrap example template wireframe cover">
  <meta name="author" content="Pingendo">
  <!-- CSS dependencies -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="wireframe.css">
</head>
<style>
  .responsive-table {
    width: 100%;
    overflow-x: auto;
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
            <a class="nav-link" href="menu.php"><b class="text-primary">Menú</b></a>
          </li>
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

   <?php
    // Obtener el valor de claveInterna del formulario
    if($_SESSION["nivelUsuario"] == 3) {
      $claveInterna = $_SESSION["numUsuario"];
    } else if($_SESSION["nivelUsuario"] == 2) {
      $claveInterna = $_POST['claveInterna'];
    }
    

    // Realizar la conexión a la base de datos
    $server = "www.db4free.net";
    $user = "userweb2";
    $passwd = "u5LciU#J";
    $database = "dbescuela";

    $conn = new mysqli($server, $user, $passwd, $database);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }

    // Construir la consulta SQL con la claveInterna proporcionada
    $sql = "SELECT 
    Al.claveInterna AS 'Id', 
    Al.nombreAlumno AS 'Alumno', 
    Gpo.cicloEscolar AS 'Periodo', 
    (CASE SUBSTRING(Gpo.cicloEscolar, 5, 2) 
      WHEN '1S' THEN 'Enero-Junio' 
      WHEN '2S' THEN 'Verano' 
      WHEN '3S' THEN 'Agosto-Diciembre'
      END) AS 'Sesión', 
    Mat.claveInterna AS 'Curso', 
    Mat.nombreMateria AS 'Materia', 
    Gpo.claveInterna AS 'Sección', 
    Mat.numeroCreditos AS 'Créditos', 
    ROUND((Cal.parcial_1 + Cal.parcial_2 + Cal.parcial_3) / 3 * 0.6, 2) AS 'Calif. Parcial', 
    ROUND(((Cal.parcial_1 + Cal.parcial_2 + Cal.parcial_3) / 3 * 0.6) + (Cal.ordinario * 0.4), 2) AS 'Calif. Final', 
    Prof.nombreProfesor AS 'Profesor', 
    Hor.horarioLunes AS 'Lunes', Hor.horarioMartes AS 'Martes', Hor.horarioMiercoles AS 'Miércoles', 
    Hor.horarioJueves AS 'Jueves', Hor.horarioViernes AS 'Viernes', Hor.horarioSabado AS 'Sábado', 
    Sal.nombreSalon AS 'Ubicación', 
    Sal.claveInterna AS 'Salón', 
    Cal.parcial_1 AS '1er. Parcial', Cal.parcial_2 AS '2do. Parcial', Cal.parcial_3 AS '3er. Parcial', 
    Cal.ordinario AS 'Ordinario', Cal.extraordinario AS 'Extraordinario', Kar.calificacion AS 'Calificación Kardex' 
    FROM grupo Gpo 
    INNER JOIN materia Mat ON Gpo.claveMateria = Mat.claveMateria 
    INNER JOIN profesor Prof ON Gpo.claveProfesor = Prof.claveProfesor 
    INNER JOIN horario Hor ON Gpo.claveHorario = Hor.claveHorario 
    INNER JOIN salon Sal ON Gpo.claveSalon = Sal.claveSalon 
    INNER JOIN inscripcion Ins ON Ins.claveGrupo = Gpo.claveGrupo 
    INNER JOIN alumno Al ON Ins.claveAlumno = Al.claveAlumno 
    INNER JOIN calificacion Cal ON Cal.claveInscripcion = Ins.claveInscripcion 
    INNER JOIN kardex Kar ON Kar.claveCalificacion = Cal.claveCalificacion 
    WHERE Al.claveInterna = $claveInterna";

    // Ejecutar la consulta SQL
    $result = $conn->query($sql);

    // Verificar si se obtuvieron resultados
    if ($result->num_rows > 0) {
        // Construir la tabla HTML para mostrar los resultados
        echo "<div class='responsive-table'>
                <table class='table table-bordered'>
                <thead class='thead-dark'>
                <tr>
                    <th>Id</th>
                    <th>Alumno</th>
                    <th>Periodo</th>
                    <th>Sesión</th>
                    <th>Curso</th>
                    <th>Materia</th>
                    <th>Sección</th>
                    <th>Créditos</th>
                    <th>Calif. Parcial</th>
                    <th>Calif. Final</th>
                    <th>Profesor</th>
                    <th>Lunes</th>
                    <th>Martes</th>
                    <th>Miércoles</th>
                    <th>Jueves</th>
                    <th>Viernes</th>
                    <th>Sábado</th>
                    <th>Ubicación</th>
                    <th>Salón</th>
                    <th>1er Parcial</th>
                    <th>2do. Parcial</th>
                    <th>3er. Parcial</th>
                    <th>Ordinario</th>
                    <th>Extraordinario</th>
                    <th>Calificación Kardex</th>
                </tr>
                </thead>";

        // Recorrer los resultados y mostrarlos en la tabla
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['Id'] . "</td>
                    <td>" . $row["Alumno"] . "</td>
                    <td>" . $row["Periodo"] . "</td>
                    <td>" . $row["Sesión"] . "</td>
                    <td>" . $row["Curso"] . "</td>
                    <td>" . $row["Materia"] . "</td>
                    <td>" . $row["Sección"] . "</td>
                    <td>" . $row["Créditos"] . "</td>
                    <td>" . $row['Calif. Parcial'] . "</td>
                    <td>" . $row["Calif. Final"] . "</td>
                    <td>" . $row["Profesor"] . "</td>
                    <td>" . $row["Lunes"] . "</td>
                    <td>" . $row["Martes"] . "</td>
                    <td>" . $row["Miércoles"] . "</td>
                    <td>" . $row["Jueves"] . "</td>
                    <td>" . $row["Viernes"] . "</td>
                    <td>" . $row["Sábado"] . "</td>
                    <td>" . $row["Ubicación"] . "</td>
                    <td>" . $row["Salón"] . "</td>
                    <td>" . $row["1er. Parcial"] . "</td>
                    <td>" . $row["2do. Parcial"] . "</td>
                    <td>" . $row["3er. Parcial"] . "</td>
                    <td>" . $row["Ordinario"] . "</td>
                    <td>" . $row["Extraordinario"] . "</td>
                    <td>" . $row["Calificación Kardex"] . "</td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "No se encontraron resultados.";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
?>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>