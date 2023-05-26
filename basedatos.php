<?php

function conectar(&$link, $server = 'www.db4free.net', $user = 'userweb2', $passwd = 'u5LciU#J', $database = 'dbescuela') {
        $link = mysqli_connect($server, $user, $passwd, $database);
	    if (!$link) {
		    die('Error al conectar: ' . mysql_error());
	    }
    }

    function desconectar(&$link) {
        if ($link) {
            mysqli_close($link);
        }
    }

    function test() {
        $mysql_link = null;
        conectar($mysql_link);
        echo "<<< MySQL >>>";
        desconectar($mysql_link);
    }
?>