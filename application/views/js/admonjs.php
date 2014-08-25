<script type="text/javascript">


    //configuramos el calendario de jqueryui datepicker para la region
    $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: 'Ant',
            nextText: 'Sig',
            currentText: 'Hoy',
            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
            'Jul','Ago','Sep','Oct','Nov','Dic'],
            dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
            dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
            weekHeader: 'Sm',
            dateFormat: 'yy/mm/dd',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''};
      $.datepicker.setDefaults($.datepicker.regional['es']);
 
    //VARIABLES GLOBALES PARA EL USUARIO ADMINISTRADOR
        var espera="<div class='text-center'><h5>Por favor espere...</h5><br><img src='<?=base_url()?>img/loader.gif'></div>";
        var randon_id;
        var valor;
        
        //aplicamos datepicker al input correspondiente 
     function loading(estado){
        if(estado){
            $('#wait').fadeIn('slow');
            $('#fondo').fadeIn('slow');
        }else{
            $('#wait').fadeOut('slow');
            $('#fondo').fadeOut('slow');
        }
    }       

        var panel={  
            autocompletarCadena:function(){
                $("#auto_cadena").on('keyup',function() {
                        var _cadena=$(this).val();
                        
                    if(_cadena.length>3){
                        $.ajax({
                            url: '<?=base_url()?>index.php/panel/autocompletarCadena/',
                            type: 'POST',                    
                            data: {cadena: _cadena},
                        })
                        .done(function(data) {
                            $("#caja").slideDown('slow').html(data);
                        })
                        .fail(function(data) {
                            $("div#centro").html("Error, comuniquese con el administrador");
                        })
                    }else{
                        $("div#caja").slideUp('slow');
                    }
                });
                            
            },
            saveIdCadena:function(){
                $("#centro").on('click','.opcion',function(){
                    //guardamos el id que enviaremos por AJAX
                    var _idCadena=$(this).attr('id');
                    var cadena=$(this).html();
                    
                    $.ajax({
                        url: '<?=base_url()?>index.php/panel/saveIdCadena/',
                        type: 'POST',            
                        data: {idCadena:_idCadena},
                    })
                    .done(function(data) {
                        //ponemos la opcion seleccionada en el input correspondiente
                        $("#auto_cadena").val(cadena);
                        //escondemos la caja de sugerencias
                        $("#caja").slideUp('slow');
                        //mostramos si existen productos agregados a esta cadena
                        $("#productos").html(data);
                    })
                    .fail(function() {
                        console.log("error comuniquese con el administrador");
                    });
                    
                });
            },
            saveIdPrecioProducto:function(){
                 $("#centro").on('click', 'img.precio', function() {
                        var _idprecio=$(this).attr('id');
                        var _tipo=$(this).attr('tipo');                    
                    $.ajax({
                        url: '<?=base_url()?>index.php/panel/saveIdPrecioProducto/',
                        type: 'POST',            
                        data: {idPrecio: _idprecio},
                    })
                    .done(function() {    
                        if(_tipo=="eliminar"){
                         $("#modal_cadena_delete").modal('show');                        
                        }
                        else if(_tipo=="actualizar"){
                            $("#modal_cadena_update").modal('show');
                        }
                    })
                    .fail(function() {
                        console.log("Error, comuniquese con el administrador");
                    });                    
                });
            },
            updatePrecioProducto:function(){
                $("#centro").on('click',"#update_producto" ,function() {               
                    $.ajax({
                        url: '<?=base_url()?>index.php/panel/updatePrecioProducto/',
                        type: 'POST', 
                        data:$("form#update").serialize(),
                            dataType:"json"

                        })
                        .done(function(data) {
                           if(data.exito==true){                                    
                                $("#modal_cadena_update").modal('hide');
                                $("#productos").html(data.html);
                                }else{                        
                                    $("#modal-error").slideDown('slow').html(data.html);
                                }
                        })
                        .fail(function() {
                            console.log("Error al eliminar en la tabla precio_cadena, verifique");
                        });
                });
            },
            delPrecioProducto:function(){
                 $("#centro").on('click',"#delete_producto",function() {        
                 $.ajax({
                     url: '<?=base_url()?>index.php/panel/delPrecioProducto/',
                    type: 'POST'
                    })
                .done(function(data) {
                    $("#modal_cadena_delete").modal('hide');
                    $("#productos").html(data);
                    })
                .fail(function() {
                    console.log("Error al eliminar en la tabla precio_cadena, verifique");
                    });
                }); 
            },
            insertPrecioCadena:function(){
                    $("#agregar").on('click',function(){   
                        $.ajax({
                            url: '<?=base_url()?>index.php/panel/insertPrecioCadena/',
                            type: 'POST',            
                            data: $("form#addProducto").serialize(),
                            dataType:'json'
                        })
                        .done(function(data) {
                            if(data.exito==true){
                            $("#productos").html(data.html);
                            $("#container-errores").slideUp('slow');
                                
                            }else{
                                $("#container-errores").hide('slow');
                                $("#errores").html(data.html);
                                $("#container-errores").slideDown('slow');
                            }
                        })
                        .fail(function() {
                           console.log("Error, comuniquese con el administrador");
                    });       
            
                });
            },
            infoVenta:function(){
                $("#centro").on('click', '.info', function() {   
                    var _id=$(this).attr('id');
                    $(".modal-body").load("<?=base_url()?>index.php/panel/infoVenta/"+_id+"/");
                    $("#info_venta").modal('show');                    
                });
            }
        }
        var validaciones={
            agregarExistencia:function(){
                $("#centro").on('click', '#existencia', function() {
                    
                    $.ajax({
                        url:"<?=base_url()?>index.php/validaciones/agregarExistencia",
                        type:"POST",
                        dataType:'json',
                        data:$("form").serialize(),
                        success:function(data){
                            if(data.exito==true){
                                //ocultamos div errores y mostramos div exito y vaciamos el form
                                $("div#container-errores").slideUp('slow');
                                $("form").each(function(){
                                    this.reset();
                                });
                                $("#exito").slideDown('slow');
                            }                        
                            else{
                            $("div#errores").html(data.html);
                            $("div#container-errores").hide('slow',function(){
                                $(this).slideDown('slow');
                            });
                            
                            }
                        }
                    });
                });
            },
            precioCadena:function(){

            } 
        }
        var buscarventa={
            autocompletarVenta:function(){
                $("#auto").on('keyup',function() {
                    var _cadena=$(this).val();
                    //alert(_cadena);
                    if(_cadena.length>3){
                    $.ajax({
                        url:"<?=base_url()?>index.php/buscarventa/autocompletarVenta/",
                        type:"POST",
                        data:{
                            cadena:_cadena
                        },
                        success:function(data){
                            if(data==true){
                                $("#caja").slideUp('slow');
                            }else{

                            $("#caja").slideDown('slow').html(data);
                            }
                        }
                    });
                        
                    }else{
                         $("#caja").slideUp('slow');
                    }
                });
            },
            idBusqueda:function(){
                 $("#caja").on('click','.opciones',function(){
                        //alert($(this).html());
                        var _id= $(this).prop('id');
                        var _campo=$(this).html();
                        var _tabla=$(this).attr('table');                        
                       //alert(_id+"  "+_campo);
                        $("#auto").val(_campo);
                        $('form#search [name="id"]:hidden').prop('value',_id);
                        $('form#search [name="tabla"]:hidden').prop('value',_tabla);
                        $("#caja").slideUp('slow');
                });
            },
            generales:function(){
                $("button#buscar").on('click', function() {        
                   $.ajax({
                        url:"<?=base_url()?>index.php/buscarventa/generales/",
                        type:"POST",
                        dataType:"json",
                        beforeSend:function(){
                            loading(true);
                        },
                        data:$("form#search").serialize()
                   })
                   .done(function(data){
                    if(data.exito==true){
                        $("#resultados").html(espera);
                        $("#resultados").html(data.html);
                        $("#resultados").hide('slow',function(){
                            $(this).slideDown('slow');
                        });
                        $("#container-errores").slideUp('slow');                        
                        $("#info").slideUp('slow');
                    }else{
                        $("#errores").html(data.html);
                        $("#container-errores").hide('slow',function(){
                            $(this).slideDown('slow');
                        });                       
                    }
                    loading(false);
                   })
                   .fail(function(data){        
                        console.log(data);
                        loading(false);
                   });

                });
            },
            detallados:function(){
                $("#detalle").on('click', function() {        
        
                   $.ajax({
                       url: '<?=base_url()?>index.php/buscarventa/detallados/',
                       type: 'POST',
                       dataType: 'json',
                       data:$("form#search").serialize(),
                       beforeSend:function(){
                            loading(true);
                       }
                   })
                   .done(function(data){
                       loading(false);
                       if(data.success == true){
                            $('#resultados').html(data.html);
                            $("#resultados").slideDown("slow");
                            $("#info").slideUp('slow');
                            $("#container-errores").slideUp('slow');
                       }else{
                            $("#errores").html(data.html);
                            $("#container-errores").slideDown("slow");
                            $("#resultados").hide();
                       }
                   })
                   .fail(function(data) {
                        loading(false);
                        console.log(data);
                   });
           
                });
            }            
        }
        var abono={
            autocompletar:function(){
                $("input#cadena_abono").on('keyup', function() {
                    var _cadena=$(this).val();        
                    if(_cadena.length>3){
                        $.ajax({
                            url: '<?=base_url()?>index.php/abono/autocompletarAdmon/',
                            type: 'POST',                
                            data: {cadena:_cadena}
                        })
                        .done(function(data) {
                            $("div#caja").html(data);
                            $("div#caja").slideDown('slow');
                        })
                        .fail(function() {
                            $("#centro").html("<h2>Error,comuniquese con el administrador</h2>")
                        });           
                    }else{
                        $("div#caja").slideUp('slow');
                    }
                });
            },
            saveIdAbono:function(){
                $("div#centro").on('click', 'div.opcion_abono', function(){
                    $('[name="table"]').prop('value',$(this).attr('table'));
                    $('[name="id"]').prop('value',$(this).attr('id'));
                    $('[name="suggestion"]').prop('value',$(this).text());
                    $('#caja').slideUp('slow');
                });
            },
            buscarCuenta:function(){
                $("button#buscar_abono").on('click', function() {
                    
                     $.ajax({
                        url: '<?=base_url()?>index.php/abono/buscarCuenta/',
                        type: 'POST',   
                        dataType:'json',
                        beforeSend:function(){loading(true)},
                        data: $('form').serialize()
                    })
                    .done(function(data) {
                        if(data.success == true){
                            $("div#resultados").hide('slow',function(){
                                $("div#resultados").html(data.html);                        
                            });
                            $("div#resultados").slideDown('slow');
                            $("div#container-errores").hide('slow');
                            $("div#info").hide('slow');
                        }else{
                            $("#errores").html(data.html);
                            $("#container-errores").slideDown('slow');
                        }
                        loading(false);
                    })
                    .fail(function(data){
                        console.log(data)
                        loading(false);
                    });            
                });
            },
            validarAbono:function(){
                $("button#abonar").on('click', function() {
                    var _valor=$("input#valor_abono").val();
                    var _id=$("input.id_venta").attr('id');
                        //alert(_valor);
                    $.ajax({
                        url: '<?=base_url()?>index.php/abono/validarAbono/',
                        type: 'POST',
                        dataType:'json',                
                        data: {
                            valor:_valor,
                            id_venta:_id
                            }
                        })
                        .done(function(data) {
                            if(data.success == true){
                                $("div#pregunta_abono").modal("show");
                                $("div#container-errors").hide('slow');
                            }else{

                            $("#container-errors").hide('slow',function(){
                            $("#errores").html(data.html);                    
                            })
                            $("#container-errors").show('slow');                    
                            }
                        })
                        .fail(function() {
                            $("#centro").html("<h3>Error,comuniquese con el administrador</h3>")
                    });                  
                });
            },
            insertAbono:function(){
                $("button#fin_abono").on('click', function() {
                    var _valor=$("input#valor_abono").val();
                    var _idventa=$("input.id_venta").attr('id');            
                    $.ajax({
                        url: '<?=base_url()?>index.php/abono/insertAbono/',
                        type: 'POST',                
                        data: {
                            valor:_valor ,
                            id_venta:_idventa
                        }
                    })
                    .done(function() {
                        $("div#pregunta_abono").modal("hide");
                        location.reload();
                    })
                    .fail(function() {
                        console.log("error,comuniquese con el administrador");
                    });
                    
                });  
            }
        }
        var almacen={
            modalZona:function(idProducto){
               $.ajax({
                   url: '<?=base_url()?>index.php/almacen/modalEditar',
                   type: 'POST',
                   dataType: 'html',
                   data: {id:idProducto},
               })
               .done(function(data){  
                   $('#modalEditar').html(data);
                   $('#modalEditar').modal();
               })
               .fail(function() {
                   console.log("fatal error: controller:almacen, action:modalZona");
               });
               
            },
            updateProducto:function(){
               $.ajax({
                    url: '<?=base_url()?>index.php/almacen/updateProducto',
                    type: 'POST',
                    dataType:'json',                    
                    data: $('form#formProducto').serialize()+'&id='+$('input:hidden').prop('value')
                })
                .done(function(data) {
                    if(data.success){
                        $('#modalEditar').modal('hide');
                        $('#success').show(500).delay(2000).hide(500);
                    }else{                        
                        $('form#formProducto').find('input').parent().parent().addClass('has-error');
                    }
                })
                .fail(function() {
                    console.log("error fatal: controller:almacen, action:updateProducto");
                });
                
            }//termina evento updateProducto
        }


    $(document).on('ready',function(){

        //activar fechas para inputs de busqueda
        $("input#fecha").datepicker();
        $("input#fecha2").datepicker();
             
        
    /*
    *OBJETO CONTROLADOR:VALIDACIONES
    */
        //método para subir a la db un nuevo usuario
        //método para subir a la db un nuevo producto
        //método para subir una nueva cadena
        //método para agregar existencias por zona en cada almacen
        validaciones.agregarExistencia();
        
        
   /*
    * OBJETO CONTROLADOR : BUSCARVENTA
   */
        //metodo autocompletar
        buscarventa.autocompletarVenta();
        //salvar id , cuando el usuario hace click sobre el
        buscarventa.idBusqueda();
        //ventas generales
        buscarventa.generales();
        //ventas detalladas
        buscarventa.detallados();


    /*
    *   OBJETO PANEL CONTROLADOR:PANEL
    *
    */
        //activar autocompletar para cadenas
        panel.autocompletarCadena();
        //guargar idcadena
        panel.saveIdCadena();
        //guarda el id del precio del producto y muestra ventana modal
        panel.saveIdPrecioProducto();
        //actualizar precio del producto
        panel.updatePrecioProducto();
        //eliminar precio del  producto por cadena
        panel.delPrecioProducto();
        //agregar precio al producto por cadena: precio_cadena
        panel.insertPrecioCadena();
        //información sobre la venta
        panel.infoVenta();  

    /*
    * OBJETO CONTROLADOR:ABONO
    */  

        //activar autocompletar para abono
        abono.autocompletar();
        //guardar session para abono
        abono.saveIdAbono();
        //buscar cuenta 
        abono.buscarCuenta();
        //validar abono
        abono.validarAbono();
        //insertar abono
        abono.insertAbono();
      
   //evitar que seleccionen mas de 1 checkbox
       $("#centro").on('click',"input[type=checkbox]" ,function() {
          var id=$(this).attr('id');     
          $("input[id!="+id+"]").removeAttr('checked');
       });



    });  //cierre de evento READY     

   function filterTable(string,obj){
        var trs = $(obj).find('tr');
        var match = false;
        if(string.length < 4){
            trs.show();
            return;
        }

        trs.each(function(index,element){
            if(index < 1)
                return;
            
            if($(this).is(':contains("'+string.toUpperCase()+'")') || $(this).is(':contains("'+string.toLowerCase()+'")'))
                $(this).show();
            else
                $(this).hide();

        })
    }  
    </script>