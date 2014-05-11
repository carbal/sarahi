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

        var panel={  
            autocompletar_cadena:function(){
                $("#auto_cadena").on('keyup',function() {
                        var _cadena=$(this).val();
                        
                    if(_cadena.length>3){
                        $.ajax({
                            url: '<?=base_url()?>index.php/panel/autocompletar_cadena/',
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
            info_venta:function(){
                $("#centro").on('click', '.info', function() {   
                    var _id=$(this).attr('id');
                    $(".modal-body").load("<?=base_url()?>index.php/panel/info_venta/"+_id+"/");
                    $("#info_venta").modal('show');                    
                });
            }
        }
        var validaciones={
            usuarioNuevo:function(){
                $('#centro').on('click', '#add_user', function() {                  

                    //alert($("form").serialize());
                   $.ajax({
                        url: "<?=base_url();?>index.php/validaciones/usuarioNuevo/",
                        type: "POST",                                        
                        data:$("form").serialize(),
                        success:function(data){                        
                            if(data==true){ 
                            //escondemos el div con msj de error
                            $("#container-errores").slideUp('slow');                        
                            //vaciamos el formulario
                            $('form').each(function() {
                                this.reset();
                            });
                            //mostramos msj de exito                            
                            $("div#exito").slideDown('slow');
                            }
                            else{
                            $("#errores").html(data);
                            $("div#container-errores").hide('slow',function(){
                                $(this).slideDown('slow');
                            });                            
                              
                            }
                        }
                    });   

                });
            },
            productoNuevo:function(){
                $("#centro").on('click','input#producto',function() { 
                $("centro").html(espera);
                        $.ajax({
                            url:"<?=base_url();?>index.php/validaciones/productoNuevo/",
                            type:"POST",
                            data:$("form#producto").serialize(),
                            success:function(data){
                                if(data==true){
                                //ocultar msj de errores
                                $("#container-errores").slideUp('slow');
                                //vaciar formulario
                                $("form").each(function() {
                                    this.reset();
                                });
                                //mostrar msj de exito
                                $("#exito").slideDown();
                                }else{
                                    //mostramos los errores
                                    $("#errores").html(data);

                                    $("#container-errores").hide('slow',function(){
                                        $(this).slideDown('slow');
                                    });

                                }
                            }
                        });
                });
            },
            clienteNuevo:function(){
                $("button#add_cliente").on('click',function() {
                    $.ajax({
                        url: '<?=base_url()?>index.php/validaciones/clienteNuevo/',
                        type: 'POST',
                        dataType: 'json',
                        data:$('form#cliente').serialize()
                    })
                    .done(function(data) {
                       if(data.exito==true){
                            $('div#container-errors').slideUp('slow');
                            $('div#info').show('slow',function(){
                                $(this).html(data.html);
                            });
                            //vaciamos el formulario
                             $("form#cliente").each(function(){
                                this.reset();
                            });
                       }else{
                            $("div#info").hide();
                            $('div#errors').html(data.html);
                            $('div#container-errors').hide('slow',function(){
                                $('div#container-errors').slideDown('slow');
                            });                       
                            
                       }
                    })
                    .fail(function() {
                        console.log("error, comuniquese con el administrador");
                    });
                                

                });
            },
            cadenaNueva:function(){
                    $("#centro").on('click', '#newcadena', function() {
                                   
                        $.ajax({
                            url:"<?=base_url()?>index.php/validaciones/cadenaNueva/",
                            type:"POST",
                            dataType:'json',
                            data:$("form").serialize(),
                            success:function(data){
                                if(data.exito==true){
                                    $("#container-errores").slideUp('slow');
                                    $("form").each(function(){
                                        this.reset();
                                    });
                                   $("#exito").slideDown('slow');
                                }else{
                                    $("#errores").html(data.html);
                                    $("#container-errores").hide('slow',function(){
                                        $(this).slideDown('slow');
                                    });
                                }
                            }
                        });
                    });
            },
            agregarExistencia:function(){
                $("#centro").on('click', '#existencia', function() {
                    
                    $.ajax({
                        url:"<?=base_url()?>index.php/validaciones/agregarExistencia/",
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
                        var _id= $(this).attr('id');
                        var _campo=$(this).html();
                        var _tabla=$(this).attr('table');                        
                        
                       //alert(_id+"  "+_campo);
                    $.ajax({
                        url:"<?=base_url()?>index.php/buscarventa/idbusqueda/",
                        type:"POST",
                        data:{
                            id:_id,
                            tabla:_tabla
                        },
                        success:function(){
                            $("#auto").val(_campo);
                            $("#caja").slideUp('slow');
                                    
                        }
                    });
                });
            },
            generales:function(){
                $("button#buscar").on('click', function() {        
                   $.ajax({
                        url:"<?=base_url()?>index.php/buscarventa/generales/",
                        type:"POST",
                        dataType:"json",
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
                   })
                   .fail(function(data){        
                    $("#centro").html("<h3>Error,comuniquese con el administrador</h3>");
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
                        $('#fondo').fadeIn('slow');
                        $('#wait').fadeIn('slow');
                       }
                   })
                   .done(function(data){
                        $('#fondo').fadeOut('slow');
                        $('#wait').fadeOut('slow');
                       if(data.exito==true){
                            $("#resultados").load("<?=base_url()?>index.php/buscarventa/edoGeneral/");
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
                var _id=$(this).attr('id');
                var _tabla=$(this).attr('table');
                var val=$(this).html();

                $.ajax({
                    url: '<?=base_url()?>index.php/abono/saveIdAbono/',
                    type: 'POST',                        
                    data: {
                        id:_id,
                        tabla:_tabla
                     }
                })
                .done(function() {
                    $("input#cadena_abono").val(val);
                    $("div#caja").slideUp('slow');
                })
                .fail(function() {
                    $("#centro").html("<h3>Error, comuniquese con el administrador</h3>");  
                });
                        
            });
            },
            buscarCuenta:function(){
                $("button#buscar_abono").on('click', function() {
                    var _parametro=$("input#cadena_abono").val();
                    
                     $.ajax({
                        url: '<?=base_url()?>index.php/abono/buscarCuenta/',
                        type: 'POST',   
                        dataType:'json',
                        data: {
                            parametro:_parametro
                        }
                    })
                    .done(function(data) {
                        if(data.exito==true){
                            $("div#resultados").hide('slow',function(){
                            $("div#resultados").load("<?=base_url()?>index.php/abono/obtenerResultados/");                        
                            })
                            $("div#resultados").slideDown('slow');
                            $("div#container-errores").hide('slow');
                            $("div#info").hide('slow');
                        }else{
                            $("#errores").html(data.html);
                            $("#container-errores").slideDown('slow');
                        }
                    })
                    .fail(function() {
                        $("#centro").html("<h3>Error, comuniquese con el administrador</h3>");
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
                            if(data.exito==true){
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
        validaciones.usuarioNuevo();
        //método para subir a la db un nuevo producto
        validaciones.productoNuevo();
        //metodo para subir un nuevo cliente ajax
        validaciones.clienteNuevo();
        //método para subir una nueva cadena
        validaciones.cadenaNueva();   
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
        panel.autocompletar_cadena();
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
        panel.info_venta();  

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

    </script>