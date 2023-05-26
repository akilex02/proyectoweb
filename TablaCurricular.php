
<?php
    function buscarPalabraEnArray($materiasCursadas,$materia) {
        $bandera = false;
        for($i=0; $i < count($materiasCursadas); $i++) {
            if(strcmp($materiasCursadas[$i],$materia) == 0){
                $bandera = true;
                break;
            }else{
                $bandera = false;
            }

        }
        return $bandera;
    }

    function catalagoMateriasCursadas($linkdb,$numUsuario,&$materiasCursadas){
        $query = mysqli_query($linkdb,"SELECT 
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
        Mat.numeroCreditos AS 'Créditos'
        FROM grupo Gpo 
        INNER JOIN materia Mat ON Gpo.claveMateria = Mat.claveMateria 
        INNER JOIN profesor Prof ON Gpo.claveProfesor = Prof.claveProfesor 
        INNER JOIN horario Hor ON Gpo.claveHorario = Hor.claveHorario 
        INNER JOIN salon Sal ON Gpo.claveSalon = Sal.claveSalon 
        INNER JOIN inscripcion Ins ON Ins.claveGrupo = Gpo.claveGrupo 
        INNER JOIN alumno Al ON Ins.claveAlumno = Al.claveAlumno 
        INNER JOIN calificacion Cal ON Cal.claveInscripcion = Ins.claveInscripcion 
        INNER JOIN kardex Kar ON Kar.claveCalificacion = Cal.claveCalificacion 
        WHERE Al.claveInterna = $numUsuario;");


         
        for($i=0; $i<mysqli_num_rows($query); $i++){
            $nRow = mysqli_fetch_array($query);   
            array_push($materiasCursadas,$nRow[5]);
        }
    }


    function compararArrays($seme1, $seme2,$seme3,$seme4,$seme5,$seme6,$seme7,$seme8,$seme9,&$mayorLongitud) {
        $carrera = [$seme1,$seme2,$seme3,$seme4,$seme5,$seme6,$seme7,$seme8,$seme9];
        $mayor = null;
        $mayorLongitud = 0;
        
        // Comparar la longitud de los arrays
        for($i =0; $i<9; $i++){
            if(count($carrera[$i]) > $mayorLongitud){
                $mayorLongitud = count($carrera[$i]);
            }
            
        }

    }

    function crearFila($linkdb,$consulta,$nombre){
        $query = mysqli_query($linkdb,"SELECT
        AC.claveAcademia AS 'NUM',
        M.numeroSemestre AS 'Semestre',
        AC.nombreAcademia AS 'nom',
        M.nombreMateria AS 'Materia'
        FROM academia AC 
        INNER JOIN materia M ON AC.claveAcademia = M.claveAcademia
        WHERE AC.claveAcademia = $consulta;");
        //primero de la parte primera columna PRIMERA      
        $numfil = mysqli_num_rows($query);
        //Creacion de un arreglo vacio
        $seme1 = array();
        $seme2 = array();
        $seme3 = array();
        $seme4 = array();
        $seme5 = array();
        $seme6 = array();
        $seme7 = array();
        $seme8 = array();
        $seme9 = array();

        for($i=0; $i<mysqli_num_rows($query); $i++){
            $nRow = mysqli_fetch_array($query);                                              
            if ($nRow[1] == 1 ){
                //agregar al arreglo
                array_push($seme1,$nRow[3]);
            }else if ($nRow[1] == 2){
                //agregar al arreglo
                array_push($seme2,$nRow[3]);
            }else if ($nRow[1] == 3 ){
                //agregar al arreglo
                array_push($seme3,$nRow[3]);
            }else if ($nRow[1] == 4 ){
                //agregar al arreglo
                array_push($seme4,$nRow[3]);
            }else if ($nRow[1] == 5 ){
                //agregar al arreglo
                array_push($seme5,$nRow[3]);
            }else if ($nRow[1] == 6 ){
                //agregar al arreglo
                array_push($seme6,$nRow[3]);
            }else if ($nRow[1] == 7 ){
                //agregar al arreglo
                array_push($seme7,$nRow[3]);
            }else if ($nRow[1] == 8 ){
                //agregar al arreglo
                array_push($seme8,$nRow[3]);
            }else if ($nRow[1] == 9 ){
                //agregar al arreglo
                array_push($seme9,$nRow[3]);
            }
            

        }
        
        //CREACION DE LA TABLA
        compararArrays($seme1, $seme2,$seme3,$seme4,$seme5,$seme6,$seme7,$seme8,$seme9,$mayorLongitud);
        $n=1;
        $inicio=true;
        $nSemestre=0;


        $materiasCursadas = array();  
        catalagoMateriasCursadas($linkdb,$_SESSION["numUsuario"],$materiasCursadas);
        
        


        do{
            //Cuerpo fila
            if($inicio){
                echo "<tr>";
                echo "<th rowspan='$mayorLongitud'>$nombre</th>";
                $inicio=false;
            }else{echo "<tr>";}
            /*****************SEMESTRE 1************ */
            if (!empty($seme1) && array_key_exists($nSemestre, $seme1)) {
                //arreglo contiene elementos para usar
                if( buscarPalabraEnArray($materiasCursadas,$seme1[$nSemestre])){
                    $style = "'color: red;'";
                }else{
                    $style = "color: white;";
                }
                echo "<td style=$style>$seme1[$nSemestre]</td>";
            } else {
                //arreglo vacio o indice no existe
                echo "<td>&nbsp;</td>";                                
            }
            /*****************SEMESTRE 2************ */
            if (!empty($seme2) && array_key_exists($nSemestre, $seme2)) {
                //arreglo contiene elementos para usar
                if( buscarPalabraEnArray($materiasCursadas,$seme2[$nSemestre])){
                    $style = "'color: red;'";
                }else{
                    $style = "color: white;"; 
                }
                echo "<td style=$style>$seme2[$nSemestre]</td>";
            } else {
                //arreglo vacio o indice no existe
                echo "<td>&nbsp;</td>";                                
            }
            /*****************SEMESTRE 3************ */
            if (!empty($seme3) && array_key_exists($nSemestre, $seme3)) {
                //arreglo contiene elementos para usar
                if( buscarPalabraEnArray($materiasCursadas,$seme3[$nSemestre])){
                    $style = "'color: red;'";
                }else{
                    $style = "color: white;";
                }
                echo "<td style=$style>$seme3[$nSemestre]</td>";
            } else {
                //arreglo vacio o indice no existe
                echo "<td>&nbsp;</td>";                                
            }
            /*****************SEMESTRE 4************ */
            if (!empty($seme4) && array_key_exists($nSemestre, $seme4)) {
                //arreglo contiene elementos para usar
                if( buscarPalabraEnArray($materiasCursadas,$seme4[$nSemestre])){
                    $style = "'color: red;'";
                }else{
                    $style = "color: white;";
                }
                echo "<td style=$style>$seme4[$nSemestre]</td>";
            } else {
                //arreglo vacio o indice no existe
                echo "<td>&nbsp;</td>";                                
            }
            /*****************SEMESTRE 1************ */
            if (!empty($seme5) && array_key_exists($nSemestre, $seme5)) {
                //arreglo contiene elementos para usar
                if( buscarPalabraEnArray($materiasCursadas,$seme5[$nSemestre])){
                    $style = "'color: red;'";
                }else{
                    $style = "color: white;";
                }
                echo "<td style=$style>$seme5[$nSemestre]</td>";
            } else {
                //arreglo vacio o indice no existe
                echo "<td>&nbsp;</td>";                                
            }
            /*****************SEMESTRE 6************ */
            if (!empty($seme6) && array_key_exists($nSemestre, $seme6)) {
                //arreglo contiene elementos para usar
                if( buscarPalabraEnArray($materiasCursadas,$seme6[$nSemestre])){
                    $style = "'color: red;'";
                }else{
                    $style = "color: white;";
                }
                echo "<td style=$style>$seme6[$nSemestre]</td>";
            } else {
                //arreglo vacio o indice no existe
                echo "<td>&nbsp;</td>";                                
            }
            /*****************SEMESTRE 7************ */
            if (!empty($seme7) && array_key_exists($nSemestre, $seme7)) {
                //arreglo contiene elementos para usar
                if( buscarPalabraEnArray($materiasCursadas,$seme7[$nSemestre])){
                    $style = "'color: red;'";
                }else{
                    $style = "color: white;";
                }
                echo "<td style=$style>$seme7[$nSemestre]</td>";
            } else {
                //arreglo vacio o indice no existe
                echo "<td>&nbsp;</td>";                                
            }
            /*****************SEMESTRE 8************ */
            if (!empty($seme8) && array_key_exists($nSemestre, $seme8)) {
                //arreglo contiene elementos para usar
                if( buscarPalabraEnArray($materiasCursadas,$seme8[$nSemestre])){
                    $style = "'color: red;'";
                }else{
                    $style = "color: white;";
                }
                echo "<td style=$style>$seme8[$nSemestre]</td>";
            } else {
                //arreglo vacio o indice no existe
                echo "<td>&nbsp;</td>";                                
            }
            /*****************SEMESTRE 9************ */
            if (!empty($seme9) && array_key_exists($nSemestre, $seme9)) {
                //arreglo contiene elementos para usar
                if( buscarPalabraEnArray($materiasCursadas,$seme9[$nSemestre])){
                    $style = "'color: red;'";
                }else{
                    $style = "color: white;";
                }
                echo "<td style=$style>$seme9[$nSemestre]</td>";
            } else {
                //arreglo vacio o indice no existe
                echo "<td>&nbsp;</td>";                                
            }

            $nSemestre++;//aumento de semestre
            //Final de la fila
            if($n == 9 && $inicio){
                echo "</tr>";
                $inicio=false;
                $n == 1;
            }else if($n == 8 && !$inicio){
                echo "</tr>";
                $n == 1;
            }
            
            $n++;//aumento de n
            echo "</tr>";
        }while($nSemestre < $mayorLongitud);
    }


    function tabla(){
        //Conexion a la base de datos.
        include "basedatos.php";
        $linkdb = null;
		$db = "dbescuela";
        conectar($linkdb);
		mysqli_select_db($linkdb,$db);
        $query = mysqli_query($linkdb,"SELECT
        AC.claveAcademia AS 'NUM',
        AC.nombreAcademia AS 'nom',
        M.nombreMateria AS 'Materia'
        FROM academia AC 
        INNER JOIN materia M ON AC.claveAcademia = M.claveAcademia;");

        //Generar Reporte
        echo "Consulta tu Materias: <a class=\"imprimir\" href=\"reporte.php\"> Imprimir</a>";


        //Inicio de la tabla
        echo "<table class='table table-bordered '>";
        //Encabezado tabla
        echo "<thead class='thead-dark'>";
        echo "<tr><th>Campos formativos</th>";

        //lineas de comando en php
        $semestres = 9;
        for($i=0; $i<$semestres;$i++){
            $num = $i+1;
            echo "<th>Semestre $num</th>";
        }

        echo "</tr></thead>";


        //Contenido de la tabla
        echo "<tbody>";

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
        echo "<p>Materias:</p>";
        echo "Ingles: <b style=\"color: red;\">$nIngles </b>";
        echo "Ciencias Basica: <b style=\"color: red;\">$nCBas  </b>";
        echo "Ciencias de la ingenieria: <b style=\"color: red;\">$nCIng </b>";
        echo "Ciencias sociales: <b style=\"color: red;\">$nCSoc </b>";
        echo "Ciencias aplicadas: <b style=\"color: red;\">$nIngApl </b>";
        



        //Ingles
        crearFila($linkdb,5,"Ingles");
        //Ciencias Basicas
        crearFila($linkdb,1,"Ciencias Basica");
        //Ciencias de la Ingenieria
        crearFila($linkdb,2,"Ciencias de la Ingenieria");
        //Ciencias Sociales
        crearFila($linkdb,4,"Ciencias Sociales y Humanidades");
        //Ciencias de la Ingenieria Aplicada
        crearFila($linkdb,3,"Ciencias de la Ingenieria Aplicada");
        //Fin
        echo "</tbody></table>";

    }
?>    