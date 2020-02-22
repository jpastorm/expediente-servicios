<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$fechainicio=$_POST['fechafechaInicio'];
$fechafin=$_POST['fechafechaFin'];

$consulta = "SELECT id_servicio, numero_servicio, numero_registro,nombre, evidencia,fecha,descripcion FROM servicio WHERE fecha BETWEEN '$fechainicio' AND '$fechafin'";
$resultado=$conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC); 
        //print json_encode($data, JSON_UNESCAPED_UNICODE);

        //var_dump(json_decode(json_encode($data),true));
$arr=json_decode(json_encode($data),true);

        foreach($arr as $item) { //foreach element in $arr
    		$nombre = $item['nombre']; //etc
    	//	echo $nombre."<br />";
    	}
    	?>
    	<style>
    		#customers {
    			font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    			border-collapse: collapse;
    			width: 100%;
    		}

    		#customers td, #customers th {
    			border: 1px solid #ddd;
    			padding: 8px;
    		}

    		#customers tr:nth-child(even){background-color: #f2f2f2;}

    		#customers tr:hover {background-color: #ddd;}

    		#customers th {
    			padding-top: 12px;
    			padding-bottom: 12px;
    			text-align: left;
    			background-color: #4CAF50;
    			color: white;
    		}
    	</style>
    	<table style="width:100%" id="customers">
    		<thead>
    			<tr>
    				<th>ID</th>
    				<th>N° Servicio</th>
    				<th>N° Registro</th>
    				<th>Proveedor</th>
    				<th>Fecha</th>
    				<th>Descripción</th>
    			</tr>
    		</thead>
    		<tbody>
    			<?php 
  	foreach($arr as $item) { //foreach element in $arr
  		$id_servicio = $item['id_servicio'];
  		$numero_servicio=$item['numero_servicio'];
  		$numero_registro=$item['numero_registro'];
  		$nombre=$item['nombre'];
  		$evidencia=$item['evidencia'];
  		$fecha=$item['fecha'];
  		$descripcion=$item['descripcion'];
    		//echo $nombre."<br />";
  		
  		?>
  		<tr>
  			
  			<td><?php echo $id_servicio ?></td>
  			<td><?php echo $numero_servicio ?></td>
  			<td><?php echo $numero_registro ?></td>
  			<td><?php echo $nombre ?></td>
  			<td><?php echo $fecha ?></td>
  			<td><?php echo $descripcion ?></td>
  			
  		</tr>
  		<?php 
  	}	
  	?>
  </tbody>
</table>

<script type="text/javascript">
	window.onload = function() {
		window.print();
	};
</script>