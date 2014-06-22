<div class="col-md-10 col-md-offset-1">

<div class="alert alert-info" id="exito" style="display:none;">
	<p><strong>AVISO : </strong>Se han agregado nuevos productos al almacen con exito.</p>
</div>

<legend >Agregar Productos </legend>

<div class="col-md-6">
	<form class="form form-horizontal" id="addalmacen">
	<div class="form-group">
		<label for="input1" class="col-md-4 control-label">Zona :</label>
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
		<label for="input1" class="col-md-4 control-label">Producto :</label>
		<div class="col-md-8">
	<select class="form-control" name="producto"> 
		<option selected>Elegir producto</option>		
 		<?foreach($productos as $producto):?>
 		<option value="<?=$producto['sku']?>"><?=$producto['descripcion']?></option>
 		<?endforeach;?> 		
 	</select>
		</div>
 </div>	
	<div class="form-group">
		<label for="input" class="col-md-4 control-label">Cantidad :</label>
		<div class="col-md-8">
		<input name="cantidad" class="form-control" type="text" placeholder="Requerido">
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-12">
		<input type="button" class="btn btn-lg btn-success pull-right" id="existencia" value="Agregar">
		</div>
	</div>
</form>
</div>


<div class="col-md-6">
	<div class="alert alert-danger" id="container-errores" style="display:none;">
		<p><strong>AVISO : </strong>Verifique los siguientes errores.</p>
		<br>
		<div id="errores">
		</div>

	</div>
</div>

</div>

<br>
<br>
<div class="mensaje">
</div>
