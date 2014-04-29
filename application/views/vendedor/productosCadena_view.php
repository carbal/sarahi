<div class="form-group">
	<label class="col-md-3 control-label">Producto : </label>			
	<div class="col-md-8">
		<select class="form-control" name="producto" id="producto">
			<option selected="" value="">elegir producto</option>		
			<?foreach($productos as $producto):?>
				<option value="<?=$producto['sku']?>"><?=$producto['descripcion']?></option>
			<?endforeach;?>						
		</select>				
	</div>
</div>				
<div class="form-group">
	<label class="col-md-3 control-label">Cantidad : </label>		
	<div class="col-md-8">
		<input id="cantidad" name="cantidad" class="form-control" type="text" placeholder="cantidad...">		
	</div>
</div>
<div class="form-group">
	<div class="col-md-offset-8">
		<button type="button"  class="btn btn-success btn-lg" id="devolver">Agregar</button>
	</div>
</div>