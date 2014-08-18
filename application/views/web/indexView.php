<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="<?=base_url()?>/js/jquery-2.0.2.js"></script>
<script type="text/javascript" src="<?=base_url()?>/js/bootstrap.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/web.css">
<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
<meta charset="utf-8">
<style type="text/css">
	body{
	padding: 0px;
	margin: 0px;
	font-family: 'Raleway', sans-serif;
}

#principal{
	background: url(<?=base_url()?>img/pan.jpg);
}

.row{
	padding: 0px;
	margin: 0px;
}

</style>
<script type="text/javascript">
	$(function(){
		linkInterno = $('a[href^="#"]');
	    linkInterno.on('click',function(e) {
	    e.preventDefault();
	    var href = $(this).attr('href');
	    $('html, body').animate({ scrollTop : $( href ).offset().top -100}, 'slow');
	    });
	});
	
</script>
<title>Sarahi - Galletas Integrales</title>
</head>
<body>

	<div class="row" id="principal">
		<div id="header">
		<div class="links">
		<a class="menu" href="#principal">PRINCIPAL</a>
		<a class="menu" href="#nosotros">NOSOTROS</a>
		<a class="menu" href="#mision">VISIÓN/MISIÓN</a>
		<a class="menu" href="#valores">VALORES/OBJETIVOS</a>
		<a class="menu" href="#contacto" style="border-right:solid 1px white;">CONTACTO</a>
		</div>
		</div>
			<h1>Galletas Integrales Sarahi</h1>
			<h3>Desde 1990</h3>
	</div>
	<div class="row" id="nosotros">
		<br>
		<h2>NOSOTROS</h2>
		<br>
		<br>
		<p>La marca “SARIAH”  es una empresa familiar fundada desde 1990 en la cuidad de Tizimin Yucatán por el matrimonio Solís Góngora,
		 la idea surgió por la necesidad económica y por ofrecer un producto diferente, utilizando materiales naturales siempre enfocándonos
		 en la salud y bienestar de las personas.
		</p>
		<p style="display:none;">En sus inicios trabajaban en su casa elaborando panes en el horno de la familia, se vendían en las escuelas y en la tiendita 
		naturista que se tenía en ese tiempo, los empaques eran de bolsas de nilón cerradas con un nudo, posteriormente se decidió cerrar
		 la bolsa con vela y un cuchillo para que aguantara mas la galleta.</p>
		<p style="display:none;">Al ver que no se vendía muy bien en Tizimin el Sr. Francisco Solís decidió vender sus galletas en los pueblos cercanos pero tampoco
		  tuvo éxito debido a los precios y a la costumbre de las familias de los alrededores.
			Posteriormente se contrato a un panadero y se rento un lugar para hacer las galletas y poco a poco se fue construyendo el horno de leña.
		</p>
		<br>
		<p style="display:none;">
			La necesidad y los propios clientes fueron quienes nos impulsaron a tomar la decisión de salir a promover nuestros productos a
			las ciudades cercanas, nuestro primer cliente fue Súper Maz de Mérida, quien nos oriento para tener nuestro código de barras y
			de esa manera tener la oportunidad de entrar en los súper mercados. Y por ello decidimos cambiar la bolsa de nilón con una bolsa de 
			polipropileno y una etiqueta de cartulina impresa.
			
		</p>
		<br>
		<p>
			Comenzamos a incursionar en los mercados de Mérida, Cancún y Campeche, teniendo como vendedor al Sr. Francisco Solís quien
			 recorría todas las rutas, al ver que la demanda nos superaba decidimos contratar a comisionistas ya que no bastaba con un 
			 solo vendedor, pero no funciono como se esperaba.
		</p>
		<p style="display:none;">
			Al crecer los hijos varones se interesaron en el negocio y decidieron hacerse cargo de las ventas y administración de la empresa,
			 actualmente le distribuimos a toda la península de Yucatán y a Villahermosa Tabasco.
		</p>
		<br>
		<p>
			Estamos presentes en los supermercados como Chedraui, San Francisco de Asis, Seven Eleven, Farmacias Unión, Súper Willys.
			
		</p>
		<br>
		<p>
			Gracias a la lealtad de nuestros clientes nos hemos mantenido y posicionado en el mercado de galletas integrales
			
		</p>
	</div>
	<div class="row" id="mision">
		<br>
		<h2>MISIÓN</h2>
		<br>
		<br>
		<p>Constituimos una empresa que produce alimentos de harina integral,  satisfaciendo las necesidades de nuestros consumidores con calidad, precio y servicio promoviendo una buena alimentación  y un nuevo habito de consumo a través del mejoramiento continuo de nuestros productos y procesos.</p>
		<br>
		<br>
		<h2>VISIÓN</h2>
		<br>
		<p>Crecer y posicionarnos como una empresa líder en el mercado ofreciendo productos innovadores y de la más alta calidad adelantándonos a las necesidades de la salud y el bienestar de todas las personas.</p>
	</div>
	<div class="row" id="valores">
		<br>
		<h2>VALORES</h2>
		<br><br>
		<ul>
		<li>Ser los mejores en todo lo que hacemos.</li>
		<li>Honradez.</li>
		<li>Calidad.</li>
		<li>Servicio al cliente.</li>
		<li>Compromiso.</li>
		<li>Trabajo en equipo Responsabilidad social.</li>
		</ul>
		<br>
		<h2>OBJETIVOS</h2>
		<br><br>
		<ul>
			<li>La satisfacción total de nuestros clientes.</li>
			<li>Innovar y crecer constantemente.</li>
			<li>Cumplir con nuestra promesa de calidad.</li>
			<li>La satisfacción total de todos los integrantes de nuestra empresa.</li>
		</ul>
	</div>
	<div id="contacto">
		<br>
		<h2>CONTACTO</h2>
		<br><br>
		<br><br>
		<div class="col-md-4 col-md-offset-1">
			<p><strong>Dirrección : </strong>Calle 47 núm. 348 entre 43 y 45, frente a la clinica del seguro social.</p>
			<br>
			<p><strong>Teléfono : </strong>(986) 86 33951.</p>
			<br>
			<p><strong>Email :</strong>contacto@galletassariah.com.mx</p>
		</div>
		<div class="col-md-5 col-md-offset-1">
			<form action="" class="form form-horizontal">
				<div class="form-group">
					<label for="" class="control-label col-md-5">Nombre : </label>
					<div class="col-md-7"><input type="text" class="form-control"></div>
				</div>
				<div class="form-group">
					<label for="" class="control-label col-md-5">Telefono : </label>
					<div class="col-md-7"><input type="text" class="form-control"></div>
				</div>
				<div class="form-group">
					<label for="" class="control-label col-md-5">Email :</label>
					<div class="col-md-7"><input type="text" class="form-control"></div>
				</div>
				<div class="form-group">
					<label for="" class="control-label col-md-5">Comentario : </label>
					<div class="col-md-7"><textarea rows="5" class="form-control"></textarea></div>
				</div>
				<div class="form-group">
					<button class="btn btn-sm pull-right" type="button">Enviar</button>
				</div>
			</form>
		</div>
	</div>
	<div id="footer"></div>

</body>
</html>