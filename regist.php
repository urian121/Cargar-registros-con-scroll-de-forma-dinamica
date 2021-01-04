<?php
if (isset($_POST['enviar'])) {
	 require_once ('db.php');
$nameFile  = $_FILES["imagen"]["name"]; //Recibiendo el Archivo
$titulo    = $_POST['titulo'];
$contenido = $_POST['contenido'];

date_default_timezone_set("America/Bogota");
$fech      	=  date("d/m/Y");
$hora 		= date("g:i:A");
$fecha      = $fech. ' '. $hora;


$directorio = "fotosPerfil/";
if (!file_exists($directorio)) {
    mkdir($directorio, 0777, true);
}

$archivo = $directorio . basename($nameFile); 
$tipoArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION)); 
if (move_uploaded_file($_FILES["imagen"] ["tmp_name"], $archivo)) {

	$InsertFile = ("INSERT INTO comentarios(
			  titulo,
			  contenido,
			  imagen,
			  fecha
			)
			VALUES (
			  '" .$titulo. "',
			  '" .$contenido. "',
			  '" .$nameFile. "',
			  '" .$fecha. "'
			)");
		$resultInsert = mysqli_query($conn, $InsertFile);
		print_r($InsertFile);

	}
}
 ?>

<br><br><br>
<br><br><br>
<center>
<form  enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

	titulo: <input type="text" name="titulo"> 
	<br>    
	contenido:<textarea name="contenido"></textarea>
	<br>
	Imagen:<input type="file" name="imagen">
	<br>

      <button name="enviar">
                <span>Agregar Imagen</span>
        </button>

</form>
</center>