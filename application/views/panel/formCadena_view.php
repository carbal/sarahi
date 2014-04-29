<div class="col-md-10 col-md-offset-1">
<legend>Agregar nuevo Cadena</legend>
<div class="alert alert-danger" id="container-errores" style="display:none;">
<p><strong>AVISO: Verifique los siguientes errores</strong> </p>
<br>
<div id="errores"></div>
</div>
<div class="alert alert-info" id="exito" style="display:none">
	<p><strong>AVISO :</strong>La cadena ha sido creado con exito.</p>
	<br>
	<p class="text-danger"><strong>ADVERTENCIA :</strong>Esta cadena no tiene productos asignados, 
		deseado asignarlos ahora o mas tarde?</p>
		<a class="btn btn-primary" href="<?=base_url()?>index.php/panel/formularioPrecioProductoCadena">Agregar Productos</a>
</div>

<form class="form-horizontal" role="form">
	<div class="form-group">
		<label for="input1" class="col-sm-2 control-label">Nombre Cadena :</label>
		<div class="col-sm-3">
			<input class="form-control" placeholder="Requerido" name="cadena">
		</div>
	</div>
	<div class="form-group">
		<label for="input2" class="col-sm-2 control-label">Zona :</label>
		<div class="col-sm-3">
			<select class="form-control" name="zona">
				<option selected>Elegir zona</option>
				<?foreach($zonas as $zona):?>
				<option value="<?=$zona['id_zona']?>"><?=$zona['zona']?></option>
				<?endforeach;?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="input3" class="col-sm-2 control-label" >Representante :</label>
		<div class="col-sm-3">
			<input class="form-control" name="representante" placeholder="Requerido"> 
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-2">Telefono :</label>
		<div class="col-md-3">
			<input class="form-control" name="telefono" placeholder="Requerido">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-4">
		<input type="button" class="btn btn-success btn-lg" id="newcadena" value="Agregar">
		</div>
	</div>
</form>

</div>