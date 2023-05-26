<?php
  if(isset($_GET["code"])) {
    if($_GET["code"] == 1) {  // Cerar sesión
      session_start();

      session_unset();
      session_destroy();
    }
  }
?>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- PAGE settings -->
  <link rel="icon" href="universidad.png">
  <title>Inicio de Sesion</title>
  <meta name="description" content="Wireframe design of a cover page by Pingendo">
  <meta name="keywords" content="Pingendo bootstrap example template wireframe cover">
  <meta name="author" content="Pingendo">
  <!-- CSS dependencies -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="wireframe.css">
</head>

<body class="text-center bg-dark">
  <div class="p-3 h-100 d-flex flex-column">
    <div class="container mb-auto">
      <div class="row">
        <div class="mx-auto col-md-9 bg-dark"></div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-8 mx-auto">
          <h1 class="cover-heading" style=""><b>Self Service UPSLP</b></h1>
          <form action="validar.php" method="post">
            <div class="form-group"> <label>User</label> <input class="form-control" placeholder="Enter email" required name="claveInterna"> <small class="form-text text-muted" ></small> </div>
            <div class="form-group"> <label>Password</label> <input type="password" class="form-control" placeholder="Password" required name="password"> </div>
            <button type="submit" class="btn btn-primary">Iniciar Sesion</button>
          </form>
        </div>
      </div>
    </div>
    <div class="container mt-auto bg-dark"></div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>