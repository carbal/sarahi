<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">    
    <meta name='viewport' content='width=device-width,initial-scale=1.0'>
    <title>Galletas Sarahi</title>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/jquery.ui.datepicker.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/jquery-ui.css">
    <script type="text/javascript" src="<?=base_url()?>js/jquery-2.0.2.js"></script>
    <script type="text/javascript" src="<?=base_url()?>js/bootstrap.js"></script>    
    <script src="<?=base_url()?>js/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/bootstrap.css">
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <?if($this->session->userdata('tipo')==1):?>  
    <?=$this->load->view('js/admonjs',TRUE)?>
    <?else:?>
    <?=$this->load->view('js/usuariojs',TRUE)?>
    <?endif;?>      
    <style type="text/css">
    body{        
        margin:0;
        padding:0;
        font-size: 13px;                         
    }  

    .pointer{
        cursor: pointer;
    }

    div#piepagina{
        background: rgba(0,0,0,0.90);
        color:white;

    }
    div#centro{                
        font-family: 'Raleway', sans-serif;
        margin-top: 2%;
        min-height: 450px;
    }
    a{
        cursor: pointer;        
    }
    div.row{
        margin: 0;
        padding: 0;
    } 
    div.modal-header{
        background: #428bca;
    }
    
    div#sugerencias{
        z-index: 9000;
        position: absolute;        
        max-height: 120px;
        overflow: auto;
        font-size: 12px;    
        padding: 5px;
        color: black;
        border: 1px solid #333;    
        -webkit-box-shadow: #222 5px 5px 5px;
        -moz-box-shadow: #222 5px 5px 5px;
        box-shadow: #222 5px 5px 5px;
        background: #F2F2F2;  
        display:none;  
        cursor: pointer;
    }
    div#sugerencias_venta{
        z-index: 9000;
        position: absolute;        
        max-height: 120px;
        overflow: auto;
        font-size: 12px;    
        padding: 5px;
        color: black;
        border: 1px solid #333;    
        -webkit-box-shadow: #222 5px 5px 5px;
        -moz-box-shadow: #222 5px 5px 5px;
        box-shadow: #222 5px 5px 5px;
        background: #F2F2F2;  
        display:none;  
        cursor: pointer;
    }
    div#sugerencias_venta a{
        color: black;
        text-decoration: none; 
    }
    div#sugerencias_venta a:hover{
        text-decoration: underline;
        background: #BAD3D9;
    }
    div#sugerencias div.opcion_cliente{
        color: black;
        text-decoration: none;
    }
    div#sugerencias div.opcion_cliente:hover{
        text-decoration: underline;
        background: #BAD3D9;
    }
    div#sugerencias div.opciones{
        color: black;
        padding: 5px;
        text-decoration: none;
    }
    div#sugerencias div.opciones:hover{
        text-decoration: underline;
        background: #BAD3D9;
    }
    div#caja{
        z-index: 9000;
        position: absolute;        
        max-height: 120px;
        min-width: 150px;
        overflow: auto;
        font-size: 12px;    
        padding: 0px;
        margin: 0px;
        color:black;
        border: 1px solid #333;        
        -webkit-box-shadow: #222 5px 5px 5px;
        -moz-box-shadow: #222 5px 5px 5px;
        box-shadow: #222 5px 5px 5px;
        background: white;   
        display:none;  
        cursor: pointer;
    }

    div#caja > div{
        color:black;        
        padding: 5px;
        text-transform: uppercase;
    }
    div#caja div:hover{
        text-decoration: underline;
        background: #3276b1;
    }
    img{
        cursor: pointer;
    }


    </style>
</head>
<body>
    <nav class="navbar navbar-inverse" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">T</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <?if($this->session->userdata('tipo')==1):?>
        <a class="navbar-brand" href="<?=base_url().'index.php/panel/';?>">Galletas Sariah</a>
        <?else:?>
        <a class="navbar-brand" href="<?=base_url().'index.php/vendedor/';?>">Galletas Sariah</a>
        <?endif;?>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
            <?php if($this->session->userdata('tipo')==1):?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ventas<b class="caret"></b></a>
                <ul class="dropdown-menu">
                <li><a href="<?=base_url()?>index.php/buscarventa/general/">General</a></li>
                <li><a href="<?=base_url()?>index.php/buscarventa/detallada/">Detallado</a></li>
                <li class="divider"></li>
                <li><a href="<?=base_url()?>index.php/abono">Cuentas Por Pagar</a></li>
                </ul>

            </li>
            <li><a href="<?=base_url()?>index.php/devoluciones">Devoluciones</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Almacen<b class="caret"></b></a>
                <ul class="dropdown-menu">                    
                    <li><a href="<?=base_url()?>index.php/almacen/zona/Yucatan">Yucatán</a></li>
                    <li><a href="<?=base_url()?>index.php/almacen/zona/QRoo">Quintana Roo</a></li>
                    <li><a href="<?=base_url()?>index.php/almacen/zona/Campeche">Campeche</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administrar<b class="caret"></b></a>
                <ul class="dropdown-menu">
                   <li><a href="<?=base_url()?>index.php/clientes">Clientes</a></li>  
                   <li><a href="<?=base_url()?>index.php/usuarios">Usuarios</a></li>
                   <li><a href="#">Productos</a></li>                  
                    <li class="divider"></li>
                    <li><a href="<?=base_url()?>index.php/usuarios/formUsuario">Usuario Nuevo</a></li>                    
                    <li><a href="<?=base_url()?>index.php/productos/formProducto">Producto Nuevo</a></li> 
                    <li><a href="<?=base_url()?>index.php/clientes/formCliente">Cliente Nuevo</a></li>                   
                    <li><a href="<?=base_url()?>index.php/panel/cadenaNueva">Nueva Cadena</a></li> 
                    <li><a href="<?=base_url()?>index.php/panel/agregarProductos">Agregar Productos</a></li>
                    <li><a href="<?=base_url()?>index.php/panel/precioProducto">Agregar Producto a Cadena</a></li> 
                </ul>
            </li>
        <?php else:?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ventas<b class="caret"></b></a>
                <ul class="dropdown-menu">                    
                    <li><a href="<?=base_url()?>index.php/vendedor/misventas/">General</a></li>                     
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Inventarios<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="<?=base_url()?>index.php/vendedor/miAlmacen/">Almacen General</a></li>    
                    <li><a href="<?=base_url()?>index.php/vendedor/misubAlmacen/">Mi Almacen</a></li>      
                    <li><a href="<?=base_url()?>index.php/vendedor/formSubalmacen/">Agregar Productos</a></li>                             
                </ul>
            </li>
            <li><a href="<?=base_url()?>index.php/vendedor/clientes">Clientes</a></li>
        <?endif;?>
        </ul>
        <?php if($this->session->userdata('tipo')!=1):?>
        <form class="navbar-form navbar-left" role="search">
      <div class="form-group">        
        <input type="text" class="form-control " placeholder="Buscar venta"  id="autocompletar_venta">
        <div class="col-md-4" id="sugerencias_venta" style="display:none;">
        </div>
      </div>      
      <a type="button" class="btn btn-primary">Buscar</a>
    </form>
    <?endif;?>
        <ul class="nav navbar-nav navbar-right">   
        <?if($this->session->userdata('tipo')==1):?>                   
            <a class="btn btn-danger navbar-btn" href="<?=base_url()?>index.php/panel/salir">Salir</a>            
        <?else:?>
             <a class="btn btn-danger navbar-btn" href="<?=base_url()?>index.php/vendedor/salir">Salir</a> 
        <?endif;?>

        </ul> 
    </div>  
</nav>
<div class="container" id="centro"><!--INICIO DEL DIV CENTRO , CONTENEDOR PRICIPAL-->