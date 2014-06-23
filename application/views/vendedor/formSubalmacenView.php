A<div class="col-md-8 col-md-offset-2">
	<legend>Agregar productos a subalmacen</legend>
	<div class="alert alert-danger" id="container-errors" style="display:none;">
		<p><strong>AVISO : </strong> Verifique los siguientes errrores.</p>
		<br>
		<div id="errors">
			
		</div>
	</div>
	<div class="alert alert-info" id="info" style="display:none;">
		<p><strong>AVISO : </strong>Se ha agregado un nuevo producto a miAlmacen</p>
	</div>
	<form action="" class="form-horizontal" id="subalmacen">
		<div class="form-group">
			<label for="" class="control-label col-md-2">Producto : </label>
			<div class="col-md-5">
				<select class="form-control" name="sku" id="producto">
					<option value="" selected>Elegir un producto</option>
					<?foreach($productos as $producto):?>
					<option value="<?=$producto['sku']?>"><?=$producto['descripcion']?></option>
					<?endforeach;?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-md-2">Cantidad : </label>
			<div class="col-md-5">
				<input type="" class="form-control" name="cantidad" id="cantidad">
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-offset-5">
				<button type="button" class="btn btn-success btn-lg" id="subalmacen">Agregar</button>				
			</div>
		</div>
	</form>
</div>