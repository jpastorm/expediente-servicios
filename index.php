<?php
include 'includes/header.php' 
?>
<div class="container d-flex justify-content-center">
    <div class="item_wrap">    
        <div id="appMoviles">                           
            <div class="row ">       
                <div class="col-4">        
                    <button @click="btnAlta" class="btn btn-info  d-flex align-items-center" title="Nuevo">Nuevo Registro<i class="fas fa-plus-circle fa-2x"></i></button>
                </div>
                
               <div class="col-8 text-right">                        
                <h5>Total de Expedientes: <span class="badge badge-primary">{{serviciosTotal}}</span></h5>
                <h5>Total de Expedientes por año<span> {{year}} :</span> <span class="badge badge-primary">{{servicioporfecha}}</span></h5>
            </div>  
        </div>
        
        <div class="row mt-5">
            <div class="col-lg-12">
                <h4 class="text-info">RANGO DE BUSQUEDA</h4>                
                <div>
                    <div class="row mb-3">
                        <div class="col d-flex justify-content-between align-items-center">
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Filas
                            </button>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <button class="dropdown-item" type="button" @click="listarpagedos(10)">10</button>
                                <button class="dropdown-item" type="button" @click="listarpagedos(25)">25</button>
                                <button class="dropdown-item" type="button" @click="listarpagedos(50)">50</button>
                                <button class="dropdown-item" type="button" @click="listarpagedos(100)">100</button>                                    
                            </div>
                        </div>
                        <button class="btn btn-info" data-toggle="modal" data-target="#staticBackdrop">Busqueda Avanzada</button>
                    </div>                          
                </div>
                <h4 class="text-info">BUSQUEDA POR NOMBRE DE PROVEEDOR</h4>                                
                <div class="d-flex flex-row justify-content-center align-items-center">
                 <input class="form-control mr-sm-2" type="search" placeholder="Proveedor" aria-label="Search" v-model="proveedor">
                    <label for="anioexpediente">Año:</label>
                   <input  type="text" class="form-control"name="anioexpediente" placeholder="Año de expediente"  id="expedienteanio" v-model="year">
                   <button class="btn btn-info" @click="listarpage"><i class="fas fa-search"></i></button>
             </div> 
             <nav class="mt-3">
               <ul class="pagination d-flex justify-content-between">
                   <li v-if="page <= 0" class="page-item disabled">
                       <span class="page-link" @click="anteriorpage">Anterior</span>
                   </li>
                   <li v-else class="page-item">
                      <span class="page-link" @click="anteriorpage">Anterior</span>
                  </li>
                  <li v-if="countpage==contarPaginas || contarPaginas<1" class="page-item disabled">
                    <span class="page-link" @click="siguientepage">Siguiente</span>
                </li>
                <li v-else class="page-item">
                    <span class="page-link" @click="siguientepage">Siguiente</span>
                </li>
            </ul>
        </nav>                
        <table id="example" style="width:100%" class="table table-striped mt-3">
            <thead>
                <tr class="bg-info text-light">
                    <th>ID</th>                                    
                    <th>N° Registro</th>
                    <th>N° Servicio</th>
                    <th>Proveedor</th>    
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>    
            </thead>
            <tbody>
                <tr v-for="(servicio,indice) of searchService">                               
                    <td>{{servicio.id_servicio}}</td>                                
                    <td>{{servicio.numero_registro}}</td>
                    <td>{{servicio.numero_servicio}}</td>
                    <td>{{servicio.nombre}}</td>
                    <td>{{servicio.fecha}}</td>                           
                    <td>
                        <div class="btn-group" role="group">
                            <!--<button class="btn btn-secondary" title="Editar"><i class="fas fa-pencil-alt"></i></button> -->
                            <button class="btn btn-info" title="ver" data-toggle="modal" v-bind:data-target="'.m'+servicio.id_servicio" ><i class="far fa-eye"></i></i></button> 
                            <div v-bind:class="'modal fade m'+servicio.id_servicio" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Detalle del Servicio</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                    <div class="col col-4 text-center">
                                     <div class="form-group">
                                         <label class="form-control d-flex justify-content-between align-items-center"><span>Fecha</span><i class="fas fa-arrow-right"></i></label>
                                     </div>                                             
                                     <div class="form-group">
                                         <label class="form-control d-flex justify-content-between align-items-center"><span>N° Registro</span><i class="fas fa-arrow-right"></i></label>
                                     </div>
                                     <div class="form-group">
                                      <label class="form-control d-flex justify-content-between align-items-center"><span>N° Servicio</span><i class="fas fa-arrow-right"></i></label>
                                  </div>
                                  <div class="form-group">
                                     <label class="form-control d-flex justify-content-between align-items-center"><span>Proveedor</span><i class="fas fa-arrow-right"></i></label>
                                 </div>
                                 <div class="form-group">
                                     <label class="form-control d-flex justify-content-between align-items-center"><span>Descripcion</span><i class="fas fa-arrow-right"></i></label>
                                 </div>
                             </div>
                             <div class="col col-lg-8">
                               <div class="form-group">
                                <input type="text" v-bind:value="servicio.fecha" readonly="" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" v-bind:value="servicio.numero_registro" readonly="" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" v-bind:value="servicio.numero_servicio" readonly="" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" v-bind:value="servicio.nombre" readonly="" class="form-control">
                            </div>
                            <div class="form-group">
                                <textarea readonly class="form-control">
                                    {{servicio.descripcion}}
                                </textarea> 
                            </div> 
                        </div>
                    </div>

                    <img v-bind:src="'bd/'+servicio.evidencia" class="img-fluid" alt="Responsive image">
                </div>
            </div>
        </div>
    </div>        
    <button class="btn btn-danger" title="Eliminar" @click="btnBorrar(servicio.id_servicio,servicio.evidencia)"><i class="fas fa-trash-alt"></i></button>      
</div>
</td>

</tr>    
</tbody>
</table>
<nav>
   <ul class="pagination d-flex justify-content-between">
       <li v-if="page <= 0" class="page-item disabled">
           <span class="page-link" @click="anteriorpage">Anterior</span>
       </li>
       <li v-else class="page-item">
          <span class="page-link" @click="anteriorpage">Anterior</span>
      </li>
      <li v-if="countpage==contarPaginas || contarPaginas<1" class="page-item disabled">
        <span class="page-link" @click="siguientepage">Siguiente</span>
    </li>
    <li v-else class="page-item">
        <span class="page-link" @click="siguientepage">Siguiente</span>
    </li>
</ul>
</nav>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Busqueda de Servicios por Proveedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
    <div class="row">
        <div class="col-lg-10 d-flex align-items-center justify-content-center">      
            <label>Nombre Proveedor:</label>
            <input type="text" id="provv" class="form-control" placeholder="PROVEEDOR">
            <button class="btn btn-info bg-info" @click="listarProveedores"><i class="fas fa-search"></i></button>        
        </div>
    </div>
    <table class="table mt-3">
      <thead class="thead-dark">
        <tr>
          <th scope="col">N° Registro</th>
          <th scope="col">N° Servicio</th>
          <th scope="col">Proveedor</th>
          <th scope="col">descripción</th>
          <th scope="col">Fecha</th>
          <th scope="col">Evidencia</th>
      </tr>
  </thead>
  <tbody>
    <tr v-for="provv of proveedores">
      <td> {{provv.numero_registro}} </td>
      <td> {{provv.numero_servicio}} </td>
      <td> {{provv.nombre}} </td>
      <td> {{provv.descripcion}} </td>
      <td> {{provv.fecha}} </td>
      <td>
          <a v-bind:href="'bd/'+provv.evidencia" v-bind:download="provv.numero_registro+'-'+provv.fecha" class="btn btn-success btn-sm"><i class="fas fa-download"></i></a>
      </td>
  </tr>
</tbody>
</table>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>  
<!-- Modal -->                
</div>

</div>
</div>            
</div>
</div>
</div>
</div>

<?php
include 'includes/footer.php' 
?>

</body>
</html>