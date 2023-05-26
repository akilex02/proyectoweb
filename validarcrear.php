<?php
include 'conn.php';

$conn = new mysqli($server, $user, $passwd, $database);
if(isset($_POST['submit'])){
    if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $u=$_POST["matricula"];
        $p=$_POST["clavecarrera"];
        $x=$_POST["nombre"];
        $y=$_POST["password"];
        $sql = "INSERT INTO `alumno`(`claveAlumno`, `claveInterna`, `nombreAlumno`, `claveCarrera`, `password`, `tipo`) VALUES ('0','".$u."','".$x."','".$p."','".$y."','3')";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                header("location:nuevouser.html");
            }
        }else{
            header("location:users.php");
        }
}
$conn->close();
?>