<?php
include 'conn.php';

$conn = new mysqli($server, $user, $passwd, $database);
if(isset($_POST['submit'])){
    if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

    $user=$_POST["matricula"];

    $sql = "SELECT * FROM alumno WHERE claveInterna = '$user'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $m = $row["claveInterna"];
        $n = $row["nombreAlumno"];
        $p = $row["password"];
        $c = $row["claveCarrera"];

        $url = "http://localhost/ejemplos/Proyecto/buscar.php?nombreAlumno=".urlencode($n)."&claveInterna=".urlencode($m)."&password=".urlencode($p)."&claveCarrera=".urlencode($c);
        header("location:".$url);
    }else{
        header("location:buscar.php");
    }
}
$conn->close();
?>