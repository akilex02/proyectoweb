<?php
include 'basedatos.php';
session_start();

$dataBase = "dbescuela";
$mySQL_Link = null;
$u = "";
$p = "";
$bandAcceso = true;


//valida si existe el parametros de claveInterna
if(isset($_POST["claveInterna"])){
    // la claveInterna no dee estar vacia
    if(strcmp($_POST["claveInterna"], "") != 0){
        $u = $_POST["claveInterna"];
    }else{
        $bandAcceso = false;
    }
}else{
    $bandAcceso = false;
}


//Validar si existe el parametro para el passsword 
if(isset($_POST["password"])){
    $p = $_POST["password"];
}else{
    $bandAcceso = false;
}

if ($bandAcceso) {
    conectar($mySQL_Link);
    mysqli_select_db($mySQL_Link, $dataBase);
    $sqlQuery = mysqli_query($mySQL_Link, "SELECT P.claveInterna AS Id, P.nombreProfesor AS Nombre, P.password AS Clave, P.tipoProfesor AS Tipo 
        FROM profesor P WHERE P.claveInterna = $u
        UNION SELECT A.claveInterna AS Id, A.nombreAlumno AS Nombre, A.password AS Clave, A.tipo AS Tipo 
        FROM alumno A WHERE A.claveInterna = $u;");
    
    if (mysqli_num_rows($sqlQuery) > 0) {
        $nRow = mysqli_fetch_array($sqlQuery);
        if (strcmp($p, $nRow[2]) == 0) {
            // Acceso permitido
            $_SESSION["nivelUsuario"] = $nRow[3];
            $_SESSION["numUsuario"] = $nRow[0];
            $_SESSION["nombreUsuario"] = $nRow[1];
            header("location:menu.php");
        }else {
            // Contraseña incorrecta
            header("location:iniciarss.php");
        }
    }else {
        // Usuario no registrado en la base de datos
        header("location:iniciarss.php");
    }
    desconectar($mySQL_Link);
}
else {
    // Acceso no permitido
    header("Location: iniciarss.php?cadError='Acceso no permitido'");
}



?>