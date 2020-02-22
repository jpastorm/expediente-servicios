<?php 
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$nomb_archivo=$_FILES['archivo']['name'];
$guardado=$_FILES['archivo']['tmp_name'];
$array = explode('.', $_FILES['archivo']['name']);
$extension = end($array);
$fecha=$_POST['fecha'];
$numeroregistro=$_POST['numeroregistro'];
$numeroservicio=$_POST['numeroservicio'];
$descripcion=$_POST['descripcion'];
$nombre=$_POST['nombre'];
//MOVER EL ARCHIVO
if (!is_file("documentos/".$nomb_archivo)) {
	$success=false;
	if(!file_exists("documentos")){
		mkdir("documentos",0777,true);
		if(file_exists("documentos")){
			if(move_uploaded_file($guardado, "documentos/".$nomb_archivo)){
				$success=true;
			}else{
				$success=false;
			}
		}
	}else{
		if(move_uploaded_file($guardado, "documentos/".$nomb_archivo)){
			$success=true;
		}else{
			$success=false;
		}
	}

//
	if (success==true) {
		$orderdate=$fecha;
		$orderdate = explode('-', $orderdate);
		$year = $orderdate[0];
		$month   = $orderdate[1];
		$day  = $orderdate[2];
		$evidencia="documentos/".$nomb_archivo;
		$consulta = "INSERT INTO servicio (numero_registro, numero_servicio, descripcion,evidencia,fecha,nombre,anio,mes,dia) VALUES('$numeroregistro','$numeroservicio','$descripcion','$evidencia','$fecha','$nombre','$year','$month','$day') ";  
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();   
	}
}

header('Location: ../index.php');
die();  
?>	