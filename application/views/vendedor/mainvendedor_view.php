<div class="col-md-10 col-md-offset-1">
	<div class="alert alert-success">
		<h5>Bienvenido <strong><?=$this->session->userdata('usuario')." ".$this->session->userdata('apellido');?></strong>, que desea hacer?<strong style="float:right;"><?="Fecha :".date('d/m/y')?></strong></h5>
	</div>

	<div class="row">
		<div class="col-md-3">
		    <div class="thumbnail text-center">
		      <img src="<?=base_url()?>img/vender.png">
		      <div class="caption">		        		        
		        <p><a href="<?=base_url()?>index.php/procesoventa/nuevaventa/" class="btn btn-info btn-lg" role="button">Vender</a></p>
		      </div>
		    </div>
		</div>

		<div class="col-md-3">
		    <div class="thumbnail text-center">
		      <img src="<?=base_url()?>img/abonar.png">
		      <div class="caption"> 		        
		        <p><a href="<?=base_url()?>index.php/vendedor/formularioAbono/" class="btn btn-info btn-lg" role="button">Abonar</a></p>
		      </div>
		    </div>
		</div>

		<div class="col-md-3">
		    <div class="thumbnail text-center">
		      <img src="<?=base_url()?>img/devolver.png">
		      <div class="caption">	        
		        <p><a href="<?=base_url()?>index.php/vendedor/formularioDevolver/" class="btn btn-info btn-lg" role="button">Devolver</a></p>
		      </div>
		    </div>
		</div>

		<div class="col-md-3">
		    <div class="thumbnail text-center">
		      <img src="<?=base_url()?>img/visitar.png">
		      <div class="caption">	        
		        <p><a href="<?=base_url()?>index.php/vendedor/formularioVisitar/" class="btn btn-info btn-lg" role="button">Visitar</a></p>
		      </div>
		    </div>
		</div>

	</div>

	<div class="alert alert-warning" style="display:none;">
		<h5>Pendientes importantes :</h5>
		<p>Actualmente no tiene pendientes¡</p>
	</div>
</div>