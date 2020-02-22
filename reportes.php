<?php
include 'includes/header.php' 
?>
<div class="container d-flex justify-content-center">
    <div class="item_wrap">    
        <!--  <div id="appMoviles">                           
          <div class="row ">       
                <div class="col text-right">                        
                    <h5>Total de Expedientes ENTRE FECHAS: <span class="badge badge-primary">{{totalexpedientesfecha}}</span></h5>
                </div>    
            </div>-->

            <!-- <div class="row mt-5">
                
                <div class="col-lg-12">
                     <h4 class="text-info">BUSQUEDA POR FECHAS</h4>                
                    <div>
                       <div class="row">
                            <div class="col-5 d-flex flex-row justify-content-around">
                                <label class="col-sm-3 col-form-label">
                                    Inicio
                                </label>
                                <input id="fechaInicio" type="date" name="fecha" class="form-control date mb-3">
                            </div>
                            <div class="col-5 d-flex flex-row justify-content-around">
                                <label class="col-sm-3 col-form-label">
                                    Fin
                                </label>
                                <input id="fechaFin" type="date" name="fecha" class="form-control date mb-3">
                            </div>
                            <div class="col-2">
                               <button class="btn btn-outline-info my-2 my-sm-0" @click="mostrarporfechas">Buscar</button>
                           </div>
                     </div>  
                       <h4 class="text-info">BUSQUEDA POR NOMBRE DE PROVEEDOR</h4>                                
                       <div class="d-flex flex-row justify-content-center">
                           <input class="form-control mr-sm-2" type="search" placeholder="Proveedor" aria-label="Search" v-model="proveedor">
                       </div>                 
                       <table id="example" style="width:100%" class="table table-striped mt-3">
                        <thead>
                            <tr class="bg-info text-light">
                                <th>ID</th>                                    
                                <th>N° Registro</th>
                                <th>N° Servicio</th>
                                <th>Proveedor</th>    
                                <th>Fecha</th>
                                <th>Descripción</th>
                            </tr>    
                        </thead>
                        <tbody>
                            <tr v-for="(servicio,indice) of searchService">                               
                                <td>{{servicio.id_servicio}}</td>                                
                                <td>{{servicio.numero_registro}}</td>
                                <td>{{servicio.numero_servicio}}</td>
                                <td>{{servicio.nombre}}</td>
                                <td>{{servicio.fecha}}</td>                           
                                <td>{{servicio.descripcion}}</td>

                            </tr>    
                        </tbody>
                    </table>
                  
                </div>

            </div>  
        </div>-->
        
        <div class="row-lg-12">
              <h1>Busqueda de Servicios entre fechas:</h1>
            <div class="col">
                <form action="./reportes/reporteservicio.php" method="post" class="d-flex">
                   <div class="d-flex flex-row justify-content-between">
                    <label class="col-sm-3 col-form-label">
                        Inicio
                    </label>
                    <input id="fechaInicio" type="date" name="fechafechaInicio" class="form-control date mb-3">
                </div>
                <div class="col-5 d-flex flex-row justify-content-around">
                    <label class="col-sm-3 col-form-label">
                        Fin
                    </label>
                    <input id="fechaFin" type="date" name="fechafechaFin" class="form-control date mb-3">
                </div>
                <div class="col-2">
                 <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Buscar</button>
             </div>
         </form>            
     </div>
 </div>
</div>
</div>
</div>
</div>


<script type="text/javascript">

    window.onload = function(){
  var fecha = new Date(); //Fecha actual
  var mes = fecha.getMonth()+1; //obteniendo mes
  var dia = fecha.getDate(); //obteniendo dia
  var ano = fecha.getFullYear(); //obteniendo año
  if(dia<10){

    dia='0'+dia; //agrega cero si el menor de 10
}
if(mes<10){
    mes='0'+mes //agrega cero si el menor de 10
}
console.log(ano+mes+dia);
document.getElementById('fechaInicio').value=ano+"-"+mes+"-"+dia;
document.getElementById('fechaFin').value=ano+"-"+mes+"-"+dia;
var a=document.getElementById('fechaInicio').value;
console.log(a);
}

</script>
<?php
include 'includes/footer.php' 
?>

</body>
</html>