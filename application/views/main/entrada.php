<html>
<head>
	<title>Sistema :Reporte de Ventas</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript" src="<?=base_url()?>js/jquery-2.0.2.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/bootstrap.css">	
	<style type="text/css">
	  body{
	  	background: rgba(0,0,0,1);
	  	font-family: cursive;
	  	font-size: 13px;

	  }
	  div.row{
	  	margin:0;
	  	padding: 0px;
	  }
	  #centro{
	   text-align: center;
	  	background:white;
	  	margin: 0 auto;
	  	float: none;	  	
	  	margin: 0 auto;
	  	margin-top: 10%;
	  	border-radius: 10px;
	  	-moz-border-radius:10px;
	  	-webkit-border-radius:10px;
	  	min-height: 280px;	  	
	  	-webkit-transform:scale(1); 
	  	-moz-transform:scale(1);	
	 	-o-transform:scale(1);
	 	transform:scale(1); 	

	  }
	  input[type="text"],input[type="password"]{
	  	font-size: 15px;
	  	font-family: sans-serif;
	  	letter-spacing: 2px;
	  	border-radius: 4px;

	  }
	
	</style>
</head>
<body>
	<div class="row">		
		<div class="col-sm-4" id="centro">
			<?php			 
				function limpiar($input){
					if($input!=NULL){
					$clean=str_replace('<p>','',$input);
					$clean=str_replace('</p>','',$clean);
					return $clean;						
					}else{
						return 'Usuario';
					}
				}
				function limpiar2($input){
					if($input!=NULL){
					$clean=str_replace('<p>','',$input);
					$clean=str_replace('</p>','',$clean);
					return $clean;						
					}else{
						return 'Contraseña';
					}
				}
			 ?>
			<br>					
			<img src="<?=base_url();?>img/user1.png" width="60px" height="60px">

			<br>
			<br>
			<form class="form-horizontal" method="post" action="<?php echo base_url()."index.php/main/validar/" ?>" id="loguin">
			<div class="cols-sm-8">
  			<input name="user" type="text" placeholder="<?=limpiar(form_error('user'));?>"> 
  			</div> 			
  			<br>					
  			<br><div class="cols-sm-8">
  			<input name="pass" type="password" placeholder="<?=limpiar2(form_error('pass'));?>" value="<?php echo set_value('pass')?>">  			
  			</div>
  			<br>  			  					
  			<button class="btn btn-primary btn-lg" type="submit" id="datos">Entrar</button>
    		</form>
					
		</div>
		
	</div>
</body>
</html>