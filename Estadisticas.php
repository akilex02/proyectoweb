
<?php
  session_start();

  if(!isset($_SESSION["numUsuario"])) {
    header("Location: iniciarss.php");
  }
?>
<?php
    //Conexion a la base de datos.
    include "basedatos.php";
    $linkdb = null;
    $db = "dbescuela";
    conectar($linkdb);
    mysqli_select_db($linkdb,$db);
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- PAGE settings -->
  <link rel="icon" href="universidad.png">
  <title>ESTADISTICAS</title>
  <meta name="description" content="Wireframe design of a cover page by Pingendo">
  <meta name="keywords" content="Pingendo bootstrap example template wireframe cover">
  <meta name="author" content="Pingendo">
  <!-- CSS dependencies -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="wireframe.css">


  <?php
    $query = mysqli_query($linkdb,"SELECT
    AC.claveAcademia AS 'NUM',
    AC.nombreAcademia AS 'nom',
    M.nombreMateria AS 'Materia'
    FROM academia AC 
    INNER JOIN materia M ON AC.claveAcademia = M.claveAcademia;");
    /* Conteo Materias de academia*/
    $nCBas = 0;//1
    $nCIng= 0;//2
    $nIngApl= 0;//3
    $nCSoc= 0;//4
    $nIngles= 0;//5
    for($i = 0; $i<mysqli_num_rows($query); $i++){
        $nRow = mysqli_fetch_array($query);	
        if($nRow[0] == 1){
            $nCBas++;
        }else if($nRow[0] == 2){
            $nCIng++;
        }else if($nRow[0] == 3){
            $nIngApl++;
        }else if($nRow[0] == 4){
            $nCSoc++;
        }else{
            $nIngles++;
        }
        
    }

    $cantidad = array($nCBas,$nCIng,$nIngApl,$nCSoc,$nIngles);

      //Librerias
      echo "<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>";
      echo "<script type='text/javascript'>";
      echo "google.charts.load('current', {'packages':['corechart']});";
      echo "google.charts.setOnLoadCallback(drawChart);";

      //Codigo
      echo "function drawChart() {";
      echo "var data = google.visualization.arrayToDataTable([";
      echo "['Task', 'Hours per Day'],";
      $query = "SELECT * FROM `academia`;";
      $consulta = mysqli_query($linkdb,$query);
      $i=0;  
      while($resultado = mysqli_fetch_assoc($consulta)){
        echo "['".$resultado['nombreAcademia']."',".$cantidad[$i]."],";
        $i++;
      }

      echo "]);";

      echo "var options = {";
      echo "title: 'Escuela'";
      echo "};";


      echo "var chart = new google.visualization.PieChart(document.getElementById('piechart'));";
      echo "chart.draw(data, options);";
      echo "}";

      echo "</script>";
  ?>

  <!-- Grafico de Barras Script -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ["Element", "Density", { role: "style" } ],
            <?php            


                $query = "SELECT * FROM `academia`;";
                $consulta = mysqli_query($linkdb,$query);

                //coloritos

                $colores = array('red', 'blue', 'green', 'yellow', 'orange');

                $i=0;
                while($resultado = mysqli_fetch_assoc($consulta)){
                    echo "['".$resultado['nombreAcademia']."',".$cantidad[$i].",'".$colores[$i]."'],";
                    $i++;
                }       
            
            
            ?>
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
                        { calc: "stringify",
                            sourceColumn: 1,
                            type: "string",
                            role: "annotation" },
                        2]);

        var options = {
            title: "Academia",
            width: 600,
            height: 400,
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
        chart.draw(view, options);
        }
    </script>





</head>

<body class="text-center bg-dark">
  <div class="row bg-dark">
    <div class="mx-auto col-md-9">
      <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container">
          <a class="navbar-brand" href="#"><b>Estadistica</b></a>
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

  
  <!-- DIV del carusell -->
  <div class="py-5 bg-info">
    <div class="container">
      <div class="row">
        <div class="text-center mx-auto col-lg-8 col-10">
          <h1 class="mb-3" style="background-color: #888888; color: white; padding: 10px; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">Estadistica</h1>
          <div id="carousel1" class="carousel slide carousel-fade" data-ride="carousel" data-interval="5000">
            <div class="carousel-inner">
              <div class="carousel-item active"> <img class="d-block w-100" src="https://developingthebusiness.com/wp-content/uploads/2018/05/Estadisticas-de-ventas.jpg"> </div>
              <div class="carousel-item"> <img class="d-block w-100" src="https://concepto.de/wp-content/uploads/2018/08/Estadistica-inferencial-min-e1533841676384-800x400.jpg"> </div>
              <div class="carousel-item"> <img class="d-block w-100" src="https://images.squarespace-cdn.com/content/v1/5595c56fe4b0f75fd2944465/1584118121191-HXE7S3CDSODU85OYQIL3/Estadisticas.jpg"> </div>
            </div>
            <ol class="carousel-indicators">
              <li data-target="#carousel1" data-slide-to="0" class="active"> </li>
              <li data-target="#carousel1" data-slide-to="1"> </li>
              <li data-target="#carousel1" data-slide-to="2"> </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>
  

  <!-- Diferente div -->
  <div class="container mt-auto bg-info">---------------------------------------------------------------------------------------------------------------------------------------------------------------------------</div>
  <!--  Titulo  -->
  <div class="py-5 text-center bg-info" style="">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 style="background-color: #888888; color: white; padding: 10px; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">INFORMACION RECABADA</h1>
        </div>
      </div>
    </div>
  </div>

  <!--  Primero  -->
  <div class="bg-info">
    <div class="container-fluid">
      <!-- Inicio -->
      <!-- 1.- -->
      <div class="row">
        <div class="px-md-5 p-3 d-flex flex-column justify-content-center text-center col-lg-6">
          <h1 >Academia Materias</h1>
          <p class="mb-3 lead">Materias en cada una de las academias de nuestra escuela</p> <a class="btn btn-link" href="#" style="color: white;">Ver</a>
        </div>
        <div class="p-0 col-lg-6"> 
            <!-- Grafico 1 -->
            <div id="piechart" style="width: 500px; height: 300px;"></div>
        </div>
      </div>


      <!-- Diferente div -->
      <div class="container mt-auto bg-info">---------------------------------------------------------------------------------------------------------------------------------------------------------------------------</div>
      
      <!-- 2.- -->    
      <div class="row">
        <div class="p-0 col-lg-6"> 
              <!-- Grafico 2 -->
              <div id="columnchart_values" style="width: 900px; height: 300px; display: flex; justify-content: center; align-items: center; height: 100vh;"></div>
          </div>
        <div class="px-md-5 p-3 d-flex flex-column justify-content-center text-center col-lg-6">
          <?php
                echo "<h1>Materias:</h1>";
                echo "Ingles: <b style=\"color: red;\">$nIngles </b>";
                echo "Ciencias Basica: <b style=\"color: red;\">$nCBas  </b>";
                echo "Ciencias de la ingenieria: <b style=\"color: red;\">$nCIng </b>";
                echo "Ciencias sociales: <b style=\"color: red;\">$nCSoc </b>";
                echo "Ciencias aplicadas: <b style=\"color: red;\">$nIngApl </b>";
          ?>
        </div>
        
      </div>

      <div class="container mt-auto bg-info">---------------------------------------------------------------------------------------------------------------------------------------------------------------------------</div>

      <!-- Fin -->
    </div>
  </div>
  
  <!-- footer -->
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
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous" style=""></script>
</body>

</html>