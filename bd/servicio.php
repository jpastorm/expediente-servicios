<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$_POST = json_decode(file_get_contents("php://input"), true);
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_servicio = (isset($_POST['id_servicio'])) ? $_POST['id_servicio'] : '';
$numeroregistro = (isset($_POST['numeroregistro'])) ? $_POST['numeroregistro'] : '';
$numeroservicio = (isset($_POST['numeroservicio'])) ? $_POST['numeroservicio'] : '';
$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
$evidencia = (isset($_POST['evidencia'])) ? $_POST['evidencia'] : '';
$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

//ESTO ES LA PAGINACION
$page = (isset($_POST['page'])) ? $_POST['page'] : '';
$limit = (isset($_POST['limit'])) ? $_POST['limit'] : '';
//LISTAR POR FECHAS
$fechaInicio = (isset($_POST['fechaInicio'])) ? $_POST['fechaInicio'] : '';
$fechaFin = (isset($_POST['fechaFin'])) ? $_POST['fechaFin'] : '';
$year = (isset($_POST['year'])) ? $_POST['year'] : '';
//LISTAR PROVEEDORES
$proveedor = (isset($_POST['proveedor'])) ? $_POST['proveedor'] : '';
switch($opcion){
    case 1:
   /* header('Access-Control-Allow-Origin: *');
    if (move_uploaded_file($_FILES["file"]["tmp_name"], "upload/".$_FILES['file']['name'])) {
        $evidencia="upload/".$_FILES['file']['name'];
        $consulta = "INSERT INTO servicio (numero_registro, numero_servicio, descripcion,evidencia,fecha,nombre) VALUES('$numeroregistro','$numeroservicio','$descripcion','$evidencia','$fecha','$nombre') ";  
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                */
        
        $consulta="SELECT id_servicio,numero_servicio,numero_registro,nombre,evidencia,fecha,evidencia from servicio where id_servicio='$id'";
        $resultado=$conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC); 
        break;
        case 2:

        break;        
        case 3:
        if (file_exists($evidencia)) {
            if(unlink($evidencia)){
               $consulta = "DELETE FROM servicio where id_servicio='$id_servicio'"; 
               $resultado = $conexion->prepare($consulta);
               $resultado->execute();     
           } 
       }else{
        $consulta = "DELETE FROM servicio where id_servicio='$id_servicio'"; 
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();     
    }

    break;         
    case 4:
    $consulta = "SELECT COUNT(*) as total FROM servicio where anio='$year'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchColumn();
    break;
    case 5:
    $consulta = "SELECT id_servicio, numero_servicio, numero_registro,nombre, evidencia,fecha,descripcion FROM servicio  where anio='$year' ORDER BY id_servicio DESC limit $page,$limit";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    break;
    case 6:
    $consulta = "SELECT id_servicio, numero_servicio, numero_registro,nombre, evidencia,fecha,descripcion FROM servicio WHERE fecha BETWEEN '$fechaInicio' AND '$fechaFin'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    break;
    case 7:
    $consulta = "SELECT numero_registro,numero_servicio,nombre,descripcion,fecha,evidencia FROM servicio where nombre LIKE '%$proveedor%'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    break;
    case 8:
    $consulta = "SELECT COUNT(*) as total FROM servicio";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchColumn();
    break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;