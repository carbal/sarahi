<div class="col-md-10 col-md-offset-1">

<div class="alert alert-info" id="exito" style="display:none">
	<p><strong>AVISO :</strong>La cadena ha sido creado con exito.</p>
	<br>
	<p class="text-danger"><strong>ADVERTENCIA :</strong>Esta cadena no tiene productos asignados, 
		deseado asignarlos ahora o mas tarde?</p>
		<a class="btn btn-primary" href="<?=base_url()?>index.php/panel/precioProducto">Agregar Productos</a>
</div>

<legend>Cadena Nueva</legend>


<div class="col-md-6">
	<form class="form-horizontal" role="form">
	<div class="form-group">
		<label for="input1" class="col-md-4 control-label">Nombre Cadena :</label>
		<div class="col-md-8">
			<input class="form-control" placeholder="Requerido" name="cadena">
		</div>
	</div>
	<div class="form-group">
		<label for="input2" class="col-md-4 control-label">Zona :</label>
		<div class="col-md-8">
			<select class="form-control" name="zona">
				<option selected>Elegir zona</option>
				<?foreach($zonas as $zona):?>
				<option value="<?=$zona['id_zona']?>"><?=$zona['zona']?></option>
				<?endforeach;?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="input3" class="col-md-4 control-label" >Representante :</label>
		<div class="col-md-8">
			<input class="form-control" name="representante" placeholder="Requerido"> 
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-4">Telefono :</label>
		<div class="col-md-8">
			<input class="form-control" name="telefono" placeholder="Requerido">
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-12">
		<input type="button" class="btn btn-success btn-lg pull-right" id="newcadena" value="Agregar">
		</div>
	</div>
</form>
</div>


<div class="col-md-6">
	<div class="alert alert-danger" id="container-errores" style="display:none;">
	<p><strong>AVISO: Verifique los siguientes errores</strong> </p>
	<br>
	<div id="errores"></div>
	</div>
</div>


</div>