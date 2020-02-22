var url = "bd/servicio.php";

var appMoviles = new Vue({    
  el: "#appMoviles",   
  data:{     
   serviciosTotal:0,
   servicioporfecha:0,
   serviciospage:[],
   servicio:[],
   proveedores:[],          
   nombre:"",
   numero_registro:0,
   numero_servicio:0,
   descripcion:"",
   evidencia:"",
   fecha:"",
   file: '',
   proveedor:'',
   page:0,
   limit:10,
   countpage:1,
   fechaInicio:"",
   fechaFin:"",
   year:"" 
 },    
 methods:{  
    //BOTONES        
    btnAlta:async function(){    

      Swal.fire({
        title: 'NUEVO REGISTRO',
        html:
        '<form method="post" action="bd/file.php" enctype="multipart/form-data">'+
        '<div class="row">'+
        '<input id="fecha" type="date" name="fecha" class="form-control date mb-3">'+
        '<label class="col-sm-3 col-form-label">'+
        'N° Registro'+
        '</label>'+
        '<div class="col-sm-7">'+
        '<input id="numeroregistro" name="numeroregistro" type="number" class="form-control">'+
        '</div>'+
        '</div>'+
        '<div class="row">'+
        '<label class="col-sm-3 col-form-label">'+
        'N° Servicio'+
        '</label>'+
        '<div class="col-sm-7">'+
        '<input id="numeroservicio" name="numeroservicio" type="number" class="form-control">'+
        '</div>'+
        '</div>'+
        '<div class="row">'+
        '<label class="col-sm-3 col-form-label">'+
        'Proveedor'+
        '</label>'+
        '<div class="col-sm-7">'+
        '<input id="nombre" name="nombre" type="text" class="form-control">'+
        '</div>'+
        '</div>'+
        '<div class="row">'+
        '<label class="col-sm-3 col-form-label">'+
        'Descripcion'+
        '</label>'+
        '<div class="col-sm-7">'+
        '<textarea  id="descripcion" name="descripcion" class="form-control" rows="4" cols="50">Una descripcion</textarea>'+
        '</div>'+
        '</div>'+
        '<br>'+
        '<div class="row">'+
        '<label class="col-sm-3 col-form-label">'+
        'Evidencia'+
        '</label>'+
        '<div class="col custom-file d-flex align-items-start">'+
        '<input type="file" class="custom-file-input" id="customFileLang" lang="es" name="archivo">'+
        '<label class="custom-file-label" for="file">Seleccionar Archivo</label>'+
        '</div>'+
        '</div>'+
        '<button class="btn btn-primary btn-block mt-3">Guardar</button>'+
        '</form>',            

        showCloseButton: true,
        showCancelButton: false,
        focusConfirm: false,
        showConfirmButton: false
      })
      this.getfecha();
    },

    getfecha:function(){

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
  document.getElementById('fecha').value=ano+"-"+mes+"-"+dia;
} ,        
    /*btnEditar:async function(id, marca, modelo, stock){                            
        await Swal.fire({
        title: 'EDITAR',
        html:
        '<div class="form-group"><div class="row"><label class="col-sm-3 col-form-label">Marca</label><div class="col-sm-7"><input id="marca" value="'+marca+'" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Modelo</label><div class="col-sm-7"><input id="modelo" value="'+modelo+'" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Stock</label><div class="col-sm-7"><input id="stock" value="'+stock+'" type="number" min="0" class="form-control"></div></div></div>', 
        focusConfirm: false,
        showCancelButton: true,                         
        }).then((result) => {
          if (result.value) {                                             
            marca = document.getElementById('marca').value,    
            modelo = document.getElementById('modelo').value,
            stock = document.getElementById('stock').value,                    
            
            this.editarMovil(id,marca,modelo,stock);
            Swal.fire(
              '¡Actualizado!',
              'El registro ha sido actualizado.',
              'success'
            )                  
          }
        });
        
      },  */      
      btnBorrar:function(id,evi){        
        Swal.fire({
          title: '¿Está seguro de borrar el registro: '+id+" ?",         
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor:'#d33',
          cancelButtonColor:'#3085d6',
          confirmButtonText: 'Borrar'
        }).then((result) => {
          if (result.value) {            
            this.borrarServicio(id,evi);             
            //y mostramos un msj sobre la eliminación  
            Swal.fire(
              '¡Eliminado!',
              'El registro ha sido borrado.',
              'success'
              )
          }
        })                
      },
      listarProveedores:function(){
        var provv=document.getElementById('provv').value;
        console.log(provv);
        axios.post(url, {opcion:7,proveedor:provv}).then(response =>{
         this.proveedores= response.data;
         console.log(response.data);
       });
      },

      listarpage:function(){
        this.page=0;
        this.countpage=0;
        /*console.log(this.page)
        console.log(typeof(this.page))
        console.log(this.limit)
        console.log(typeof(this.limit))*/
       // console.log(this.year);
        axios.post(url, {opcion:5,page:this.page,limit:this.limit,year:this.year}).then(response =>{
         this.serviciospage= response.data;
         console.log(response.data);
       });
        this.expedienteporfecha();
      },
      listarpagedos:function(limit){
        this.page=0;
        this.countpage=0;
        /*console.log(this.page)
        console.log(typeof(this.page))
        console.log(this.limit)
        console.log(typeof(this.limit))*/
        axios.post(url, {opcion:5,page:this.page,limit:limit,year:this.year}).then(response =>{
         this.serviciospage= response.data;
         console.log(response.data);
       });
        this.limit=limit;

      },
      siguientepage:function(){
        this.page+=this.limit;
        this.countpage++;
        axios.post(url,{opcion:5,page:this.page,limit:this.limit,year:this.year}).then(response=>{
          this.serviciospage=response.data;
          console.log(response.data);
        });
      },
      anteriorpage:function(){
        this.page-=this.limit;
        this.countpage--;
        axios.post(url,{opcion:5,page:this.page,limit:this.limit,year:this.year}).then(response=>{
          this.serviciospage=response.data;
          console.log(response.data);
        });
      },
    //PROCEDIMIENTOS para el CRUD     
    /*
    listarServicios:function(){
      axios.post(url, {opcion:4,year:this.year}).then(response =>{
       this.servicios = response.data;
       console.log(response.data);
     });
   },*/
   fechainput:function(){
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
  this.year=ano;
},
   //Procedimiento CREAR.
   altaServicio:function(){
      /*console.log(this.numero_registro)
      this.numero_registro=parseInt(this.numero_registro)
      console.log(typeof(this.numero_registro))
      console.log(this.numero_servicio)
      this.numero_servicio=parseInt(this.numero_servicio)
      console.log(typeof(this.numero_servicio))
      console.log(this.descripcion)
      console.log(this.evidencia)
      console.log(this.fecha)
      console.log(this.nombre)*/
      let formData = new FormData();
      formData.append('file', this.file);

      axios.post(url, {opcion:1,
        formData,
        numeroregistro:this.numero_registro,
        numeroservicio:this.numero_servicio,
        descripcion:this.descripcion,
        fecha:this.fecha,
        nombre:this.nombre, headers: {
          'Content-Type': 'multipart/form-data'
        } }

        ).then(response =>{
          this.expedientecompleto();
          this.expedienteporfecha();
        })
        .catch(function(){
          console.log('FAILURE!!');
        });        
        this.numero_registro = 0,
        this.numero_servicio = 0,
        this.descripcion = "",
        this.evidencia="",
        this.fecha="",
        this.nombre=""
      },               
    //Procedimiento EDITAR.
    /*
    editarMovil:function(id,marca,modelo,stock){       
       axios.post(url, {opcion:2, id:id, marca:marca, modelo: modelo, stock:stock }).then(response =>{           
           this.listarMoviles();           
        });                              
      },*/    
    //Procedimiento BORRAR.
    borrarServicio:function(id,evi){
      //console.log(id);
      //console.log(evi);
      axios.post(url, {opcion:3, id_servicio:id,evidencia:evi}).then(response =>{           
        this.listarpage();
        this.expedientecompleto();
        this.expedienteporfecha();
      });
    },
    mostrarServicio:function(id){
      axios.post(url, {opcion:1,id:id}).then(response =>{
       this.servicio = response.data;
       console.log(response.data);
     });
    },
    mostrarporfechas:function(id){
      this.fechaInicio=document.getElementById('fechaInicio').value;
      this.fechaFin=document.getElementById('fechaFin').value;
      axios.post(url, {opcion:6,fechaInicio:this.fechaInicio,fechaFin:this.fechaFin}).then(response =>{
       this.serviciospage = response.data;
       console.log(response.data);
     });
    },
    expedientecompleto:function(){
      axios.post(url, {opcion:8}).then(response =>{
        this.serviciosTotal = response.data;
        console.log(response.data);
      });
      return this.serviciosTotal;
    },
    expedienteporfecha:function(){
      axios.post(url, {opcion:4,year:this.year}).then(response =>{
        this.servicioporfecha = response.data;
        console.log(response.data);
      });
      return this.servicioporfecha;
    },              
  },      
  created: function(){            
    this.fechainput();
    this.expedientecompleto();
    this.expedienteporfecha();
    this.listarpage();
    

  },    
  computed:{
    /*totalStock(){
        this.total = 0;
        for(movil of this.moviles){
            this.total = this.total + parseInt(movil.stock);
        }
        return this.total;   
      }*/
      totalexpedientesfecha(){
        return this.serviciospage.length;
      },
      searchService:function(){
        return this.serviciospage.filter((item)=>item.nombre.includes(this.proveedor));
      },
      contarPaginas:function(){
        var paginas=this.servicioporfecha;
        var total=parseInt(paginas);
        console.log(Math.ceil(total/this.limit));
        return Math.ceil(total/this.limit);
      }
    }    
  });
