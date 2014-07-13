<script type="text/javascript">
var espera="<div class='text-center'><p>Por favor espere...</p><br><br><img src=';'img/loader.gif'?>'img/loader.gif'></div>";
        var randon_id;
        var valor;

var vendedor={
    autocompletarClientes:function(){
        $("input#autocompletar_clientes").on('keyup',function() {
            var _cadena=$(this).val();
            if(_cadena.length>=4){
                $.ajax({
                    url: '<?=base_url()?>index.php/vendedor/autocompletarClientes/',
                    type: 'POST',           
                    data: {cadena:_cadena},
                })
                .done(function(data) {
                    $("div#sugerencias").html(data);                    
                    $("div#sugerencias").slideDown('slow');
                })
                .fail(function() {
                    console.log("error, controller: vendedor, metodo:autocompletarClientes");
                });              
            }else{
                $("div#sugerencias_clientes").slideUp('slow');
            }
        });        
    },
    idCliente:function(){
        $("div#centro").on('click','div.opcion_cliente', function() {
            var _val=$(this).html();
            var _rfc=$(this).attr('id');

            $.ajax({
                url: '<?=base_url()?>index.php/vendedor/idCliente/',
                type: 'POST',                
                data: {
                    rfc:_rfc
                }
            })
            .done(function() {
                $('div#sugerencias').slideUp('slow');
                $('input#autocompletar_clientes').val(_val);
            })
            .fail(function() {
                console.log("error, controller:vendedor, método:idCliente");
            });
            
        });
    },
    validarVisitar:function(){
        $("button#visitar").on('click',function() {
            
           $.ajax({
               url: '<?=base_url()?>index.php/vendedor/validarVisitar/',
               type: 'POST',
               dataType: 'json',
               data:$('form#visitar').serialize(),
           })
           .done(function(data) {
               if(data.exito==true){
                $("div#info").show('slow');
                $('div#container-errors').slideUp('slow');
                $('form').each(function() {
                    this.reset();
                });
               }else{
                $('div#errors').html(data.html);
                $('div#container-errors').hide('slow', function() {
                    $(this).slideDown('slow');
                });

               }
           })
           .fail(function() {
               console.log("error, Controller:vendedor, método:validarVisitar");
           });
           
        });
    },
    productosCadena:function(){
        $('button#productos').on('click', function(event) {
            $.ajax({
                url: '<?=base_url()?>index.php/vendedor/productosCadena/',
                type: 'POST',
                dataType: 'json'                
            })
            .done(function(data) {
                if(data.exito==true){
                    $('div#productos').html(data.html);
                    $('div#container-errors').hide('slow');
                }else{
                    $('div#container-errors').hide('slow',function(){
                        $('div#errors').html(data.html);                        
                    })
                    $('div#container-errors').slideDown('slow'); 
                    $('div#info').hide('slow');
                }
            })
            .fail(function() {
                console.log("error, Controller: Vendedor, método:productosCadena");
            });
                                
        });
    },
    validarDevolver:function(){
        $("div#centro").on('click','button#devolver',function() {
            //alert($('form#devolver').serialize());
            $.ajax({
                url: '<?=base_url()?>index.php/vendedor/validarDevolver/',
                type: 'POST',
                dataType: 'json',
                data:$('form#devolver').serialize(),
            })
            .done(function(data) {
                if(data.exito==true){                    
                    $('div#info').html(data.html);
                    $('container-errors').hide('slow');
                    $('div#info').html(data.html);
                    //vaciar los inputs correspondientes.
                    $('input#cantidad').val("");
                    $('select#producto').val("");
                }else{
                    $("div#container-errors").hide('slow',function(){
                        $(this).slideDown('slow',function(){
                            $('div#errors').html(data.html);
                        });
                    });

                }
            })
            .fail(function() {
                console.log("error");
            });
            
        });
    },
    autocompletarVenta:function(){
        $('input#autocompletar_venta').on('keyup',function() {
            var _cadena=$(this).val();
            if(_cadena.length>=4){
                $.ajax({
                    url: '<?=base_url()?>index.php/vendedor/autocompletarVenta/',
                    type: 'POST',                    
                    data: {
                        cadena:_cadena
                    }
                })
                .done(function(data) {
                    $('div#sugerencias_venta').html(data);
                    $('div#sugerencias_venta').slideDown('slow');
                })
                .fail(function() {
                    console.log("error, Controller: Vendedor, método: autocompletarVenta");
                });            

            }else{
                $('div#sugerencias_venta').slideUp('slow');
            }
        });        
    },
    validarSubAlmacen:function(){
        $('button#subalmacen').on('click',function(){
            //alert($('form#subalmacen').serialize());
            $.ajax({
                url: '<?=base_url()?>index.php/vendedor/validarSubAlmacen/',
                type: 'POST',
                dataType: 'json',
                data:$('form#subalmacen').serialize(),
            })
            .done(function(data) {
                if(data.exito==true){
                    $('div#container-errors').hide('slow');
                    $('div#info').show('slow');
                }else{
                    $('div#container-errors').hide('slow',function(){
                        $('div#errors').html(data.html);
                        $(this).slideDown('slow');
                    })
                }
            })
            .fail(function() {
                console.log("error, Controller:vendedor, método:validarSubAlmacen");
            });
            
            
        });
    }
}
var buscarventa={
    info_venta:function(){
                $("#centro").on('click', '.info', function() {   
                    var _id=$(this).attr('id');
                    $("div#info_venta div.modal-body").load("<?=base_url()?>index.php/buscarventa/info_venta/"+_id+"/");
                    $("div#info_venta").modal('show');                    
                });
            }
}
var ventas={
        autocompletar:function(){
            $("input#autocompletar").on('keyup', function() {                
               var cadena=$(this).val();
               if(cadena.length>3){

                $.ajax({
                    url:"<?=base_url()?>index.php/ventas/getClientes",
                    type:"POST",
                    data:{string:cadena},
                    success:function(data){                
                        if(data.length>0){
                            $("div#sugerencias").slideDown('slow').html(data);
                        }
                        else{
                            $("div#sugerencias").hide('slow');
                        }
                    }

                });

               }else{

                $("div#sugerencias").hide('slow');        
               }
             });
        },
        sugerencias:function(){
             $("div#sugerencias").on('click','div.opciones', function(event) {        
                var _rfc=$(this).attr('id');        
                var valor=$(this).html();        
                $("input#autocompletar").val(valor);
                $("div#sugerencias").hide('slow');
                
                $.ajax({
                    url:"<?=base_url()?>index.php/ventas/datosCliente/",
                    type:"POST",
                    dataType:'json',
                    data:{rfc:_rfc},
                    success:function(data){
                        $('div#deuda').hide();
                        $("div#2paso").hide().fadeIn('slow',function(){
                            $(this).html(data.html);                    
                        });

                        if(data.deuda==true){
                            $('div#deuda').show('slow');
                        }
                    }
                });
            });
        },        
        addProducto:function(){
             $("#centro").on('click',"#carrito", function(event) {
                var _sku=$("#id_producto").prop('value');
                var _describe = $('#id_producto :selected').html();
                var _precio=$("#precio").prop('value');
                var _cantidad=$("#cantidad").prop('value');     
        
                $.ajax({
                url:"<?=base_url()?>index.php/ventas/addProductos/",
                type:"POST",            
                data:{
                    sku:_sku,
                    precio:_precio,
                    describe :_describe,
                    cantidad:_cantidad
                },
                success:function(data){
                    if(data==true){
                        $("#errores").slideUp('slow');
                        $("#tercero").hide('slow');
                        $("#tercero").show('slow');
                        $("#3paso").load("<?=base_url()?>index.php/ventas/tablaProductos/");
                    }else{                    
                        $("#errores").html("<p><strong>AVISO : </strong>Verifique los siguientes errores</p><br>"+data);
                        $("#errores").hide('slow',function(){
                            $(this).slideDown('slow');

                        });
                    }
                }
                });   
                });

        },
        modalVaciar:function(){
            $("#centro").on('click','#cancelar', function() {
                $.ajax({
                    url:"<?=base_url()?>index.php/ventas/existen_productos/",
                    type:"POST",
                    success:function(data){
                        if(data==true){
                        $("#modalVenta").modal('show');                            
                        }else{

                        }
                       
                    }
                });

            });

        },
        vaciar:function(){
             $("#vaciar").on('click', function() {

                $.ajax({
                    url:"<?=base_url()?>index.php/ventas/vaciar/",
                    type:"POST",
                    success:function(data){
                        $("#modalVenta").modal('hide');
                        $("#3paso").html(data);
                    }
                });
            });
        },
        eliminarProducto:function(){
            $("#3paso").on('click',"img.delete",function() {
                var _sku=$(this).attr('id');

                $.ajax({
                    url:"<?=base_url()?>index.php/ventas/eliminarProducto",
                    type:"POST",
                    data:{
                        sku:_sku
                    },
                    success:function(){
                        $("tr."+_sku).fadeOut('slow');
                    }
                });        
        
            });
        },
        modalEfectivo:function(){

                $("#centro").on('click', '#modal_efectivo', function() {
                    $.ajax({
                    url:"<?=base_url()?>index.php/ventas/existen_productos/",
                    type:"POST",
                    success:function(data){
                        if(data==true){
                        $("#venta_efectivo").modal("show");

                        }else{

                        }
                       
                    }

                });
            });
        },
        modalCredito:function(){

            $("#centro").on('click', '#modal_credito', function() {
                $.ajax({
                url:"<?=base_url()?>index.php/ventas/existen_productos/",
                type:"POST",
                success:function(data){
                    if(data==true){
                    $("#venta_credito").modal("show");
                    }else{

                    }
                   
                    }
                });
                    
            });

        },
        ventaEfectivo:function(){

             $("#centro").on('click', '#efectivo', function() {

                $("#venta_efectivo").modal("hide");
                $.ajax({
                    url: '<?=base_url()?>index.php/ventas/finalizar_venta/',
                    type: 'POST',            
                    data: {tipo_venta:$(this).attr('id')},
                })
                .done(function() {            
                    $("#centro").load("<?=base_url()?>index.php/ventas/msj_success/");
                })
                .fail(function() {            
                    $("#centro").load("<?=base_url()?>index.php/ventas/msj_error/");
                });                
            });

        },
        ventaCredito:function(){

            $("#centro").on('click', '#credito', function() {
                $("#venta_credito").modal("hide");
                $.ajax({
                    url: '<?=base_url()?>index.php/ventas/finalizar_venta/',
                    type: 'POST',            
                    data: {tipo_venta:$(this).attr('id')},
                })
                .done(function() {            
                  $("#centro").load("<?=base_url()?>index.php/ventas/msj_success/");
                })
                .fail(function() {            
                    $("#centro").load("<?=base_url()?>index.php/ventas/msj_error/");
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
                            url: '<?=base_url()?>index.php/abono/autocompletarVendedor/',
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

$(document).on('ready', function() {    
    /*
    *   OBJETO VENDEDOR
    */
    //autocompletar clientes,
    vendedor.autocompletarClientes();
    //guardar idcliente->rfc
    vendedor.idCliente();
    //validar visitar
    vendedor.validarVisitar();
    //mostrar productos
    vendedor.productosCadena();
    //validar devolver
    vendedor.validarDevolver();
    //autcompletar busquedas de ventas por cliente
    vendedor.autocompletarVenta();
    //validar formulario de subalmacen
    vendedor.validarSubAlmacen();


        
	/*
    *   OBJETO BUSCARVENTA
    */
    buscarventa.info_venta();

    /*
    *   OBJETO VENTA
    */

    //autocompletar , buscar cliente para venta
    ventas.autocompletar();
    //clic sobre sugerencia
    ventas.sugerencias();
    //agregar producto a pila de productos
    ventas.addProducto();
    //mostrar modal , confirmar si desea vaciar la pila de productos
    ventas.modalVaciar();
    //vaciar toda la pila de productos
    ventas.vaciar();
    //Eliminar producto de la pila de productos
    ventas.eliminarProducto();
    //mostrar el modal efectivo
    ventas.modalEfectivo();
    //mostrar modal credito
    ventas.modalCredito();
    //finalizar venta en efectivo
    ventas.ventaEfectivo();
    //finalizar venta a credito
    ventas.ventaCredito();



    /*
    * OBJETO ABONO
    */
    
    //autocompletar clientes para realizar abono
    abono.autocompletar();
    abono.saveIdAbono();
    abono.buscarCuenta();
    abono.validarAbono();
    abono.insertAbono();
      
   
     //EN RELACION A CONTROLADOR: PROCESOVENTA, METODO:datos_cliente, vista: procesoventa/detalles_cliente
     $("div#centro").on('change','select#id_producto',function() {
        
            var _precio=$("select#id_producto :selected").attr('precio');
            $("input#precio").val(_precio);
     });

     function filterTable(string,obj)
     {
        var trs = $(obj).find('tr');

        if(string.length < 4)
            return;
        else
            trs.show();

        trs.each(function(){
            if($(this).toLowerCase().indexOf(string) < 0)
                $(this).slideUp();
        })
     }  
    
});
</script>