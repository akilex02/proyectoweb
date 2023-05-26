<?php
    function obtenerPlanesEstudios() {
        // Establecer la conexión a la base de datos
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

        // Consulta SQL para recuperar los planes de estudios
        $query = "SELECT * FROM planmateria";
        $result = $conn->query($query);

        // Cerrar la conexión
        $conn->close();

        // Retornar los resultados de la consulta
        return $result;
    }
?>