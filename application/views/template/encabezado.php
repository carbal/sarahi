<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">    
    <meta name='viewport' content='width=device-width,initial-scale=1.0'>
    <title>Galletas Sarahi</title>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/jquery.ui.datepicker.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/cssBase.css">
    <script type="text/javascript" src="<?=base_url()?>js/jquery-2.0.2.js"></script>
    <script type="text/javascript" src="<?=base_url()?>js/bootstrap.js"></script>    
    <script src="<?=base_url()?>js/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/bootstrap.css">
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <style type="text/css">
        body{        
            margin:0;
            padding:0;
            font-family: 'Raleway', sans-serif;
            font-size: 13px;                         
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
                <li><a href="<?=base_url()?>index.php/bitacora">Bitácora</a></li>
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
                   <li><a href="<?=base_url()?>index.php/usuarios">Usuarios</a></li>
                   <li><a href="<?=base_url()?>index.php/clientes">Clientes</a></li>
                   <li><a href="<?=base_url()?>index.php/cadenas">Cadenas</a></li>  
                   <li><a href="<?=base_url()?>index.php/productos">Productos</a></li>                  
                    <li class="divider"></li>
                    <li><a href="<?=base_url()?>index.php/usuarios/formUsuario">Usuario Nuevo</a></li>                    
                    <li><a href="<?=base_url()?>index.php/clientes/formCliente">Cliente Nuevo</a></li>                   
                    <li><a href="<?=base_url()?>index.php/cadenas/formCadena">Cadena Nueva</a></li> 
                    <li><a href="<?=base_url()?>index.php/productos/formProducto">Producto Nuevo</a></li> 
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