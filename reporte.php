
<?php
  session_start();

  if(!isset($_SESSION["numUsuario"])) {
    header("Location: iniciarss.php");
  }
?>

<?php
require('PDF/fpdf.php');
include "basedatos.php";
$linkdb = null;
$db = "dbescuela";
conectar($linkdb);
mysqli_select_db($linkdb,$db);

$pdf = new FPDF();


if($_SESSION["nivelUsuario"] == 2) {
    //*****************************************PAGINA 1********************************************** */

    $pdf->AddPage();


    $leftMargin = 15; // 1.5 cm equivalen a 15 unidades en FPDF
    $topMargin = 15; // 1.5 cm equivalen a 15 unidades en FPDF

    $pdf->SetMargins($leftMargin, $topMargin);

    /*HEADER */
    //Arial bold 15
    $pdf->SetFont('Arial','B',16);
    //Movernos a la derecha
    $pdf->Cell(60);
    //Titulo
    $pdf->SetX(50);
    $pdf->Cell(40,10,utf8_decode('Materias De la Carrera ITI'));
    //Saldo de linea
    $pdf->Ln(20);
    $nombre = $_SESSION["nombreUsuario"];

    $pdf->SetXY(50,20);
    $pdf->SetTextColor(0, 255, 0); // Establecer color de texto a rojo
    $pdf->Cell(30,10,"De: ".utf8_decode($nombre),0,1,'C',0);
    $pdf->SetTextColor(0, 0, 0); // Establecer color de texto a NEGRO


    $pdf->SetX(50);
    $pdf->SetTextColor(0, 255, 0); // Establecer color de texto a VERDE
    $pdf->Cell(120,10,'Materias',1,1,'C',0);
    $pdf->SetTextColor(0, 0, 0); // Establecer color de texto a negro


    //CHECAR INGLES
    $consulta = "SELECT * FROM materia";
    $resultado = mysqli_query($linkdb,$consulta);

    $contador = 20;
    for($i=0; $i<mysqli_num_rows($resultado); $i++){
        $nRow = mysqli_fetch_array($resultado);
        $texto = utf8_decode($nRow[2]);
        
        $anchoMaximo = 30; // Ancho máximo permitido para la cadena en la celda

        if (strlen($texto) > $anchoMaximo) {
            $texto = substr($texto, 0, $anchoMaximo) . "..."; // Corta la cadena y agrega puntos suspensivos al final
        }
        $pdf->SetX(50);    
        $pdf->Cell(120,10,$texto,1,1,'C',0);
        $pdf->SetTextColor(0, 0, 0); // Establecer color de texto a negro
        if(((($i-1)%$contador) == 0) && ($i-1) != 0){
            /**FOOTER  */
            //Arial italic 8
            $pdf->SetFont('Arial','I',8);
            //Número de página
            $pdf->Cell(0,10,utf8_decode('Página').$pdf->PageNo(),0,0,'C');

            $pdf->AddPage();
            //Arial bold 15
            $pdf->SetX(50);
            $pdf->SetFont('Arial','B',16);
            $pdf->SetTextColor(0, 255, 0); // Establecer color de texto a rojo
            $pdf->Cell(120,10,'Materias',1,1,'C',0);
            $pdf->SetTextColor(0, 0, 0); // Establecer color de texto a negro
            $contador*2;
        }

    }

    /**FOOTER  */
    //Arial italic 8
    $pdf->SetFont('Arial','I',8);
    //Número de página
    $pdf->Cell(0,10,utf8_decode('Página').$pdf->PageNo(),0,0,'C');

        
    
}else{
    //*****************************************PAGINA 1********************************************** */
    $pdf->AddPage();

    $leftMargin = 15; // 1.5 cm equivalen a 15 unidades en FPDF
    $topMargin = 15; // 1.5 cm equivalen a 15 unidades en FPDF

    $pdf->SetMargins($leftMargin, $topMargin);

    $pdf->SetFont('Arial', '', 12);
    /*HEADER */
    //Arial bold 15
    $pdf->SetFont('Arial','B',16);
    //Movernos a la derecha
    $pdf->Cell(60);
    //Titulo
    $pdf->Cell(40,10,utf8_decode('Reporte de Materias Cursadas'));
    //Saldo de linea
    $pdf->Ln(20);
    $nombre = $_SESSION["nombreUsuario"];

    $pdf->SetXY(50,20);
    $pdf->SetTextColor(0, 255, 0); // Establecer color de texto a rojo
    $pdf->Cell(30,10,"De: ".utf8_decode($nombre),0,1,'C',0);
    $pdf->SetTextColor(0, 0, 0); // Establecer color de texto a NEGRO


    $pdf->Cell(30,10,'Periodo',1,0,'C',0);
    $pdf->Cell(120,10,'Materias',1,0,'C',0);
    $pdf->Cell(30,10,'Creditos',1,1,'C',0);

  

    $numUsuario = $_SESSION["numUsuario"];

    $consulta = "SELECT 
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
    Cal.ordinario AS 'final'
    FROM grupo Gpo 
    INNER JOIN materia Mat ON Gpo.claveMateria = Mat.claveMateria 
    INNER JOIN profesor Prof ON Gpo.claveProfesor = Prof.claveProfesor 
    INNER JOIN horario Hor ON Gpo.claveHorario = Hor.claveHorario 
    INNER JOIN salon Sal ON Gpo.claveSalon = Sal.claveSalon 
    INNER JOIN inscripcion Ins ON Ins.claveGrupo = Gpo.claveGrupo 
    INNER JOIN alumno Al ON Ins.claveAlumno = Al.claveAlumno 
    INNER JOIN calificacion Cal ON Cal.claveInscripcion = Ins.claveInscripcion 
    INNER JOIN kardex Kar ON Kar.claveCalificacion = Cal.claveCalificacion 
    WHERE Al.claveInterna = $numUsuario;";
    $resultado = mysqli_query($linkdb,$consulta);

    $materiasCursadas = array(); 
    for($i=0; $i<mysqli_num_rows($resultado); $i++){
        $nRow = mysqli_fetch_array($resultado);   
        array_push($materiasCursadas,$nRow[5]);
    }

    $consulta = "SELECT 
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
    Cal.ordinario AS 'final'
    FROM grupo Gpo 
    INNER JOIN materia Mat ON Gpo.claveMateria = Mat.claveMateria 
    INNER JOIN profesor Prof ON Gpo.claveProfesor = Prof.claveProfesor 
    INNER JOIN horario Hor ON Gpo.claveHorario = Hor.claveHorario 
    INNER JOIN salon Sal ON Gpo.claveSalon = Sal.claveSalon 
    INNER JOIN inscripcion Ins ON Ins.claveGrupo = Gpo.claveGrupo 
    INNER JOIN alumno Al ON Ins.claveAlumno = Al.claveAlumno 
    INNER JOIN calificacion Cal ON Cal.claveInscripcion = Ins.claveInscripcion 
    INNER JOIN kardex Kar ON Kar.claveCalificacion = Cal.claveCalificacion 
    WHERE Al.claveInterna = $numUsuario;";
    $resultado = mysqli_query($linkdb,$consulta);

    while($row = $resultado->fetch_assoc()){
        if($row['final'] == ""){

            $pdf->Cell(30,10,utf8_decode($row['Periodo']),1,0,'C',0);
            $texto = utf8_decode($row['Materia']);
            $anchoMaximo = 25; // Ancho máximo permitido para la cadena en la celda

            if (strlen($texto) > $anchoMaximo) {
                $texto = substr($texto, 0, $anchoMaximo) . "..."; // Corta la cadena y agrega puntos suspensivos al final
            }
            $pdf->SetTextColor(255, 0, 0); // Establecer color de texto a rojo
            $pdf->Cell(120,10,"Cursando->".$texto,1,0,'C',0);
            $pdf->SetTextColor(0, 0, 0); // Establecer color de texto a negro
            $pdf->Cell(30,10,utf8_decode($row['Créditos']),1,1,'C',0);

        }else{
            $pdf->Cell(30,10,utf8_decode($row['Periodo']),1,0,'C',0);
            $texto = utf8_decode($row['Materia']);
            $anchoMaximo = 30; // Ancho máximo permitido para la cadena en la celda

            if (strlen($texto) > $anchoMaximo) {
                $texto = substr($texto, 0, $anchoMaximo) . "..."; // Corta la cadena y agrega puntos suspensivos al final
            }

            $pdf->Cell(120,10,$texto,1,0,'C',0);

            $pdf->Cell(30,10,utf8_decode($row['Créditos']),1,1,'C',0);
        }
        
    }

    //CONSULTA DE TODAS LAS 
    $consulta = "SELECT * FROM materia";
    $resultado = mysqli_query($linkdb,$consulta);

    $materias = array(); 
    for($i=0; $i<mysqli_num_rows($resultado); $i++){
        $nRow = mysqli_fetch_array($resultado);   
        array_push($materias,$nRow[2]);
        if($nRow[5] == "5"){
            $ingles = $nRow[2];
            $nivel = $nRow[7];
        }
    }

    $posibleCursar = array_diff($materias, $materiasCursadas);

    $posibleCursar = array_values($posibleCursar);

    /**FOOTER  */
    //Possicion: a 1.5cm del final
    //Arial italic 8
    $pdf->SetFont('Arial','I',8);
    //Número de página
    $pdf->Cell(0,10,utf8_decode('Página').$pdf->PageNo(),0,0,'C');

    //*****************************************PAGINA 2********************************************** */

    $pdf->AddPage();


    $leftMargin = 15; // 1.5 cm equivalen a 15 unidades en FPDF
    $topMargin = 15; // 1.5 cm equivalen a 15 unidades en FPDF

    $pdf->SetMargins($leftMargin, $topMargin);

    /*HEADER */
    //Arial bold 15
    $pdf->SetFont('Arial','B',16);
    //Movernos a la derecha
    $pdf->Cell(60);
    //Titulo
    $pdf->SetX(50);
    $pdf->Cell(40,10,utf8_decode('Materias Puedes Cursar Siguiente Semestre'));
    //Saldo de linea
    $pdf->Ln(20);


    $pdf->SetX(50);
    $pdf->SetTextColor(0, 255, 0); // Establecer color de texto a VERDE
    $pdf->Cell(120,10,'Materias',1,1,'C',0);
    $pdf->SetTextColor(0, 0, 0); // Establecer color de texto a negro


    //CHECAR INGLES
    $consulta = "SELECT * FROM materia";
    $resultado = mysqli_query($linkdb,$consulta);

    $contador = 15;
    for($i=0; $i<count($posibleCursar); $i++){
        if (!empty($posibleCursar) && array_key_exists($i, $posibleCursar)){
            $texto = utf8_decode($posibleCursar[$i]);
            $ingles = substr($texto, 0, 4);
            if($ingles == "Ingl"){
                $pdf->SetTextColor(255, 128, 0); // Establecer color de texto a naranja
                $texto =  $texto." inexacto";
            }
        }else{
            $texto = "NULL";
        }
        
        $anchoMaximo = 30; // Ancho máximo permitido para la cadena en la celda

        if (strlen($texto) > $anchoMaximo) {
            $texto = substr($texto, 0, $anchoMaximo) . "..."; // Corta la cadena y agrega puntos suspensivos al final
        }
        $pdf->SetX(50);    
        $pdf->Cell(120,10,$texto,1,1,'C',0);
        $pdf->SetTextColor(0, 0, 0); // Establecer color de texto a negro
        if($i == $contador){
            /**FOOTER  */
            //Arial italic 8
            $pdf->SetFont('Arial','I',8);
            //Número de página
            $pdf->Cell(0,10,utf8_decode('Página').$pdf->PageNo(),0,0,'C');

            $pdf->AddPage();
            //Arial bold 15
            $pdf->SetX(50);
            $pdf->SetFont('Arial','B',16);
            $pdf->SetTextColor(0, 255, 0); // Establecer color de texto a rojo
            $pdf->Cell(120,10,'Materias',1,1,'C',0);
            $pdf->SetTextColor(0, 0, 0); // Establecer color de texto a negro
            
        }

    }

    /**FOOTER  */
    //Arial italic 8
    $pdf->SetFont('Arial','I',8);
    //Número de página
    $pdf->Cell(0,10,utf8_decode('Página').$pdf->PageNo(),0,0,'C');


}



$pdf->Output();
ob_end_flush();
?>