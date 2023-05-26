<?php
include 'conn.php';

$conn = new mysqli($server, $user, $passwd, $database);
if(isset($_POST['submit'])){
    if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $u=$_POST["matricula"];
        $sql = "DELETE FROM alumno WHERE claveInterna = '$u'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                header("location:eliminar.html");
            }
        }else{
            header("location:users.php");
        }
}
$conn->close();
?>